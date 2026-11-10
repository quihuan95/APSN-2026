<?php

namespace App\Http\Controllers;

use App\Mail\NewRegistrationNotification;
use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    /** @var list<string> */
    private const INVITED_EXCLUDED_SESSIONS = ['technical_visit', 'council'];

    public function create(): View
    {
        return $this->form(invited: false);
    }

    public function createInvited(Request $request): View|RedirectResponse
    {
        if (! $this->isInvitedLink($request)) {
            return redirect()->route('register');
        }

        return $this->form(invited: true);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->persist($request, invited: false);
    }

    public function storeInvited(Request $request): RedirectResponse
    {
        if (! $this->isInvitedLink($request)) {
            return redirect()->route('register');
        }

        return $this->persist($request, invited: true);
    }

    private function isInvitedLink(Request $request): bool
    {
        return $request->query->has('invited');
    }

    private function form(bool $invited): View
    {
        return view('pages.register', [
            'submissionToken' => (string) Str::uuid(),
            'invited' => $invited,
        ]);
    }

    private function persist(Request $request, bool $invited): RedirectResponse
    {
        $sessions = $invited
            ? array_diff_key(config('apsn.sessions'), array_flip(self::INVITED_EXCLUDED_SESSIONS))
            : config('apsn.sessions');

        $sessionRules = [];
        foreach (array_keys($sessions) as $key) {
            $sessionRules["sessions.{$key}"] = ['required', Rule::in(['Yes', 'No'])];
        }

        $delegateRules = $invited ? [] : [
            'economy' => ['required', Rule::in(config('apsn.economies'))],
            'attending_as' => ['required', Rule::in(config('apsn.roles'))],
            'nationality' => ['required', 'string', 'max:255'],
            'passport_type' => ['required', Rule::in(config('apsn.passport_types'))],
            'passport_number' => ['required', 'string', 'max:50'],
            'passport_expiry' => ['required', 'date', 'after:today'],
            'passport_copy' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'visa_status' => ['required', Rule::in(config('apsn.visa_statuses'))],
            'visa_email' => [
                Rule::excludeUnless($request->input('visa_status') === config('apsn.e_visa_status')),
                Rule::requiredIf($request->input('visa_status') === config('apsn.e_visa_status')),
                'email',
                'max:255',
            ],
            'arrival_at' => ['nullable', 'date'],
            'arrival_flight' => ['nullable', 'string', 'max:50'],
            'departure_at' => ['nullable', 'date', 'after_or_equal:arrival_at'],
            'departure_flight' => ['nullable', 'string', 'max:50'],
            'hotel_name' => ['nullable', 'string', 'max:255'],
        ];

        $data = $request->validate(array_merge([
            'submission_token' => ['required', 'uuid'],
            'title' => ['required', Rule::in([...config('apsn.titles'), 'other'])],
            'title_other' => ['nullable', 'required_if:title,other', 'string', 'max:100'],
            'full_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(config('apsn.genders'))],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'organization' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'sessions' => ['required', 'array'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'dietary' => ['required', Rule::in([...config('apsn.diets'), 'other'])],
            'dietary_other' => ['nullable', 'required_if:dietary,other', 'string', 'max:255'],
            'accessibility' => ['required', 'string', 'max:500'],
            'consent' => ['accepted'],
        ], $delegateRules, $sessionRules), [], [
            'nationality' => 'economy',
        ]);

        $passportCopyPath = $invited ? null : $request->file('passport_copy')?->store('passports');
        $data['passport_copy_path'] = $passportCopyPath;
        $data['is_invited'] = $invited;
        $data['consent'] = true;
        unset($data['passport_copy']);

        if ($invited) {
            $data['economy'] = null;
            $data['attending_as'] = null;
            $data['nationality'] = null;
            $data['passport_type'] = null;
            $data['passport_number'] = null;
            $data['passport_expiry'] = null;
            $data['visa_status'] = null;
            $data['visa_email'] = null;

            foreach (self::INVITED_EXCLUDED_SESSIONS as $session) {
                $data['sessions'][$session] = 'No';
            }
        }

        if ($data['title'] !== 'other') {
            $data['title_other'] = null;
        }
        if ($data['dietary'] !== 'other') {
            $data['dietary_other'] = null;
        }

        $submissionToken = $data['submission_token'];
        unset($data['submission_token']);

        $registration = Registration::query()->firstOrCreate(
            ['submission_token' => $submissionToken],
            $data,
        );

        if (! $registration->wasRecentlyCreated) {
            if ($passportCopyPath !== null) {
                Storage::delete($passportCopyPath);
            }

            return redirect()
                ->route('register.thanks')
                ->with('registration_name', $registration->full_name);
        }

        Mail::to($registration->email)->send(new RegistrationConfirmation($registration));

        $adminEmail = config('apsn.admin.email');
        if (is_string($adminEmail) && filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
            Mail::to($adminEmail)->send(new NewRegistrationNotification($registration));
        }

        return redirect()
            ->route('register.thanks')
            ->with('registration_name', $registration->full_name);
    }

    public function thanks(): View
    {
        return view('pages.thanks');
    }
}
