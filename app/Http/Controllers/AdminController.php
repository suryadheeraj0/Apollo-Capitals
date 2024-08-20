<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Mail\SendActivationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Stringable;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function createUser() {
        return view('createUser') ;
    }


    public function store(Request $request) {

        $userName = $request->name ;
        $userEmail = $request->email ;
        $userRole = $request->role ;
        $is_active = $request->is_active ;


        //return response()->json(['status' => true, 'data' => $data], 200) ;

        $dummyPassword = fake()->password(8, 20) ;
        $data = [
            'userName' => $userName, 
            '$userEmail' => $userEmail,
            'userRole' => $userRole,
            'randomPassword' => $dummyPassword,
            'is_activated' => 0
        ] ;

        $user = new User() ;
        $user->name = $userName ;
        $user->email = $userEmail ;
        $user->password = $dummyPassword ;
        $user->role = $userRole ;
        $user->save() ;

        
        $name = $user->name;
        $dummyPassword = $user->password;
        $activationLink = route('accountActivation');
        $email = $user->email;
    
       
        Mail::send(new SendActivationEmail($name, $dummyPassword, $activationLink, $email)) ;

        return redirect()->route('welcome') ;

        //id, name, email, email_verified_at, password, remember_token, created_at, updated_at, is_active

        
    }


    public function showAccountActivation() {
        return view('accountActivation') ;
    }

    public function validateAndSaveUser(Request $request) {
            $dummyPassword = $request->dummyPassword ;
            $newPassword = $request->newPassword ;
            $confirmPassword = $request->confirmNewPassword ;

            $user = User::where('password', '=', $dummyPassword)->first() ;

            $user->password = Hash::make($confirmPassword) ;
            $user->is_activated = 1 ; 
            $user->save() ;





    }
}

