<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_authenticated') === true) {
            return redirect()->route('admin.registrations.index');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle an admin login attempt.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $configuredUsername = (string) config('apsn.admin.username');
        $configuredPassword = (string) config('apsn.admin.password');

        if ($configuredUsername === '' || $configuredPassword === '') {
            return back()
                ->withErrors(['username' => 'Admin credentials are not configured on the server.'])
                ->withInput(['username' => $validated['username']]);
        }

        $isValid = hash_equals($configuredUsername, $validated['username'])
            && hash_equals($configuredPassword, $validated['password']);

        if (! $isValid) {
            return back()
                ->withErrors(['username' => 'Invalid username or password.'])
                ->withInput(['username' => $validated['username']]);
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);

        return redirect()->intended(route('admin.registrations.index'));
    }

    /**
     * Log the admin out and invalidate session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('status', 'You have been safely signed out.');
    }
}

