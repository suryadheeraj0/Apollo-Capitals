<?php 
namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OtpService
{
    public function generateOtp($userId)
    {
        $otp = rand(2000, 9000); // or use a different method to generate OTP
        DB::table('otps')->updateOrInsert(
            ['user_id' => $userId],
            ['otp' => $otp, 'expires_at' => Carbon::now()->addMinutes(1)]
        );

        return $otp;
    }
    /*

    public function verifyOtp($userId, $otp)
    {
        $record = DB::table('otps')->where('user_id', $userId)->first();
        info('verify otp on above condition') ;
        if (!$record || $record->otp !== $otp || Carbon::now()->gt($record->expires_at)) {
            info('verify otp inside condition') ;
            return false;
        }
        info('verify otp outside the condition') ;
        DB::table('otps')->where('user_id', $userId)->delete();
        return true;

    }
    */

    public function verifyOtp($userId, $otp)
    {
        // Retrieve the OTP record for the user
        $otpRecord = DB::table('otps')
            ->where('user_id', $userId)
            ->where('otp', $otp)
            ->first();

        // Check if OTP exists and is not expired
        if ($otpRecord && Carbon::parse($otpRecord->expires_at)->gt(Carbon::now())) {
            // OTP is valid
            // Optionally delete the OTP or mark it as used
            DB::table('otps')->where('user_id', $userId)->delete();
            return true;
        }

        // OTP is invalid or expired
        return false;
    }
}
