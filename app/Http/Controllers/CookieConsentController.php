<?php

namespace App\Http\Controllers;

use App\Models\CookieConsentPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CookieConsentController extends Controller
{
    public function showConsentForm()
    {
        return view('cookie-consent');  // The view where the user can give consent
    }

    public function storeConsent(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // If consent has already been stored, we can skip updating
        $consent = CookieConsentPreference::firstOrNew(['user_id' => $user->id]);

        // Save consent
        $consent->consent_given = $request->has('consent_given');
        $consent->consent_given_at = $consent->consent_given ? now() : null;
        $consent->save();

        return redirect()->back()->with('success', 'Your consent preference has been saved.');
    }
}
