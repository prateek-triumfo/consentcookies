<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCookieConsent
{
    public function handle(Request $request, Closure $next)
    {
        // If the user has not given consent and is not on the consent page, redirect them
        if (Auth::check() && !Auth::user()->cookieConsentPreference) {
            return redirect()->route('cookie-consent.show');
        }

        return $next($request);
    }
}
