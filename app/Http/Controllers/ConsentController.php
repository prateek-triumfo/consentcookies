<?php
namespace App\Http\Controllers;
use App\Models\ConsentCategory;
use App\Models\UserConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConsentController extends Controller
{
    public function index()
    {
        $categories = ConsentCategory::all();
        $userIdentifier = $this->getUserIdentifier();
        $userConsents = UserConsent::where('user_identifier', $userIdentifier)->get()
            ->pluck('enabled', 'consent_category_id');

        return view('consent.manage', compact('categories', 'userConsents'));
    }

    public function save(Request $request)
    {   

        //return response()->json(['success' => true , 'data'=>$request->input('consents')]);

        $validated = $request->validate([
            'consents' => 'required|array',
            'consents.*' => 'boolean',
        ]);
        //return response()->json(['success' => true , 'data'=>$validated]);
        $userIdentifier = $this->getUserIdentifier();

        foreach ($validated['consents'] as $categoryId => $enabled) {
            UserConsent::updateOrCreate(
                [
                    'user_identifier' => $userIdentifier,
                    'consent_category_id' => $categoryId,
                ],
                [
                    'enabled' => $enabled,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]
            );
        }

        return response()->json(['success' => true]);
    }


    
    protected function getUserIdentifier()
    {
        if (auth()->check()) {
            return 'user_' . auth()->id();
        }

        $identifier = session('consent_identifier');
        if (!$identifier) {
            $identifier = 'anonymous_' . Str::uuid();
            session(['consent_identifier' => $identifier]);
        }

        return $identifier;
    }
}
