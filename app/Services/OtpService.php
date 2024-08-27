<?php
namespace App\Services;

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class OtpService
{
    public function generateOtp($userId)
    {
        $otp = rand(2000, 9000);
        Session::put('otp', [
            'user_id' => $userId,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(1),
        ]);

        return $otp;
    }

    public function verifyOtp($userId, $otp)
    {
        
        $otpData = Session::get('otp');

        if ($otpData && $otpData['user_id'] == $userId && $otpData['otp'] == $otp) {
            if (Carbon::parse($otpData['expires_at'])->gt(Carbon::now())) {
                Session::forget('otp');
                return true;
            } else {
                Session::forget('otp');
            }
        }

        return false;
    }
}
