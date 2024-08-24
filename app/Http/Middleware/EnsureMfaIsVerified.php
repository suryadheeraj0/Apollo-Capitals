<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureMfaIsVerified
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // Check if the user has MFA enabled and if they are verified
        if ($user->two_factor_secret && $user->two_factor_recovery_codes) {
            return redirect()->route('two-facto-authentication'); // Redirect to MFA verification page
        }

        return $next($request);
    }
}
