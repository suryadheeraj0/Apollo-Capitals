<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Notifications\OtpNotification;
use App\Providers\RouteServiceProvider;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        /*
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            info($request->password) ;
            info($request->email) ;
        } else {
            info('Login failed', ['email' => $request->email, 'password' => $request->password]);
        } */
        /*
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->dummyPassword, $user->password)) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            info('auth not working') ;
            return redirect()->back()->withErrors(['dummy_password' => 'The password does not match our records.']);
        }
        */
        //$request->authenticate();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            if($user->is_mfa_enabled){
                $otpService = new OtpService();
                $otp = $otpService->generateOtp($user->id);
                $user->notify(new OtpNotification($otp));

                return redirect()->route('otp.verify');
            }else {
                return redirect()->route('dashboard') ;
            }
            
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);


        $request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);
        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $userId = $user->id ;
        $user = User::find($userId) ;
        if($user->enable_disable_at_logout) {
            $user->is_mfa_enabled = true;
            $user->save();
        }else {
            $user->is_mfa_enabled = false;
            $user->save();
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        

        return redirect('/');
    }
}
