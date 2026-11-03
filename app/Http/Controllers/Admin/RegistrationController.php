<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $registrations = Registration::query()
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query
                        ->where('full_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('organization', 'like', "%{$search}%")
                        ->orWhere('economy', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(25)
            ->withQueryString();

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'search' => $search,
            'totalRegistrations' => Registration::count(),
            'todayRegistrations' => Registration::whereDate('created_at', today())->count(),
        ]);
    }

    public function show(Registration $registration): View
    {
        return view('admin.registrations.show', ['registration' => $registration]);
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $fullName = $registration->full_name;
        $id = $registration->id;

        if ($registration->passport_copy_path && Storage::exists($registration->passport_copy_path)) {
            Storage::delete($registration->passport_copy_path);
        }

        $registration->delete();

        return redirect()
            ->route('admin.registrations.index')
            ->with('status', "Registration #{$id} ({$fullName}) was deleted successfully.");
    }

    public function bulkDestroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:registrations,id'],
        ]);

        $registrations = Registration::whereIn('id', $validated['ids'])->get();
        $count = $registrations->count();

        foreach ($registrations as $registration) {
            if ($registration->passport_copy_path && Storage::exists($registration->passport_copy_path)) {
                Storage::delete($registration->passport_copy_path);
            }

            $registration->delete();
        }

        return redirect()
            ->route('admin.registrations.index')
            ->with('status', "{$count} registration(s) deleted successfully.");
    }

    public function passport(Registration $registration): StreamedResponse
    {
        abort_unless(Storage::exists($registration->passport_copy_path), 404);

        $extension = pathinfo($registration->passport_copy_path, PATHINFO_EXTENSION);

        return Storage::download(
            $registration->passport_copy_path,
            "passport-{$registration->id}.{$extension}",
        );
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'w');

            if ($output === false) {
                return;
            }

            fwrite($output, "\xEF\xBB\xBF");
            fputcsv($output, [
                'ID', 'Submitted At', 'Full Name', 'Title', 'Gender', 'Date of Birth',
                'APEC Economy', 'Organization', 'Position', 'Attending As', 'Economy',
                'Passport Type', 'Passport Number', 'Passport Expiry', 'Visa Status',
                'Visa Email', 'Sessions', 'Arrival', 'Arrival Flight', 'Departure',
                'Departure Flight', 'Hotel', 'Contact Email', 'Phone', 'Dietary',
                'Accessibility',
            ]);

            Registration::query()
                ->orderBy('id')
                ->each(function (Registration $registration) use ($output): void {
                    fputcsv($output, array_map($this->sanitizeCsvCell(...), [
                        $registration->id,
                        $registration->created_at?->format('Y-m-d H:i:s'),
                        $registration->full_name,
                        $registration->title === 'other' ? $registration->title_other : $registration->title,
                        $registration->gender,
                        $registration->date_of_birth?->format('Y-m-d'),
                        $registration->economy,
                        $registration->organization,
                        $registration->position,
                        $registration->attending_as,
                        $registration->nationality,
                        $registration->passport_type,
                        $registration->passport_number,
                        $registration->passport_expiry?->format('Y-m-d'),
                        $registration->visa_status,
                        $registration->visa_email,
                        implode('; ', array_keys(array_filter($registration->sessions, fn (string $value): bool => $value === 'Yes'))),
                        $registration->arrival_at?->format('Y-m-d H:i:s'),
                        $registration->arrival_flight,
                        $registration->departure_at?->format('Y-m-d H:i:s'),
                        $registration->departure_flight,
                        $registration->hotel_name,
                        $registration->email,
                        $registration->phone,
                        $registration->dietary === 'other' ? $registration->dietary_other : $registration->dietary,
                        $registration->accessibility,
                    ]));
                });

            fclose($output);
        }, 'apsn-registrations-'.now()->format('Y-m-d').'.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function sanitizeCsvCell(mixed $value): string
    {
        $value = (string) ($value ?? '');

        if (preg_match('/^[=+\-@\t\r]/', $value) === 1) {
            return "'{$value}";
        }

        return $value;
    }
}
