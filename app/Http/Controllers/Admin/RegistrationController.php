<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RegistrationsExport;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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
        $passportCopyPath = $registration->passport_copy_path;

        abort_unless($passportCopyPath && Storage::exists($passportCopyPath), 404);

        $extension = pathinfo($passportCopyPath, PATHINFO_EXTENSION);

        return Storage::download(
            $passportCopyPath,
            "passport-{$registration->id}.{$extension}",
        );
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(
            new RegistrationsExport,
            'apsn-registrations-'.now()->format('Y-m-d').'.xlsx',
        );
    }
}
