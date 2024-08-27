<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationJob;
use App\Jobs\SendOtpNotificationJob;
use App\Notifications\OtpNotification;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }
    public function show()
    {
        return view('auth.otp'); // Create this view
    }

    public function verify(Request $request)
{
    $request->validate([
        'otp' => 'required',
    ]);

    $otpService = new OtpService();
    if ($otpService->verifyOtp(auth()->user()->id, $request->otp)) {
        session(['otp_verified' => true]);
        return redirect()->intended('dashboard');
    }

    return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP']);
}
public function requestNewOtp(Request $request)
{
    $user = Auth::user();
    $otp = $this->otpService->generateOtp($user->id);
    //$user->notify(new OtpNotification($otp));
    info(auth()->user()->email) ;
    SendOtpNotificationJob::dispatch($otp, auth()->user()) ;

    //return response()->json(['message' => 'New OTP has been sent to your email.']);
    return redirect()->back() ;//->with('message', 'New OTP has been sent to your email.') ;
}
}
