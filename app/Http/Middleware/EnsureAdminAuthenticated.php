<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $username = (string) config('apsn.admin.username');
        $password = (string) config('apsn.admin.password');

        if ($username === '' || $password === '') {
            abort(503, 'Admin credentials are not configured.');
        }

        $isSessionAuthenticated = $request->session()->get('admin_authenticated') === true;

        $isBasicAuthenticated = $request->getUser() !== null
            && hash_equals($username, (string) $request->getUser())
            && hash_equals($password, (string) $request->getPassword());

        if (! $isSessionAuthenticated && ! $isBasicAuthenticated) {
            if ($request->expectsJson()) {
                return response('Authentication required.', 401, [
                    'WWW-Authenticate' => 'Basic realm="APSN Registration Admin", charset="UTF-8"',
                ]);
            }

            return redirect()->guest(route('admin.login'));
        }

        $response = $next($request);
        $response->headers->set('Cache-Control', 'no-store, private');

        return $response;
    }
}
