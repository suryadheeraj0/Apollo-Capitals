<?php


namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Events\WelcomeMailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidationRequest;
use App\Http\Requests\ValidateAndSaveUserRequest;
use App\Jobs\SendAccountSuccessMail;
use App\Mail\SendActivationEmail;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Stringable;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    //showing admin dashboard
    public function showAdminPage(User $user) {


        $this->authorize('adminPageAccess', $user) ;

        return view('admin_dashboard');
    }

    public function createUser() {
        $roles = Role::all() ;
        return view('createUser', compact('roles')) ;
    }

    public function store(UserValidationRequest $request) {

        $request->validated() ;

        $userName = $request->name ;
        $userEmail = $request->email ;
        $userRole = $request->role ;

        //return response()->json(['status' => true, 'data' => $data], 200) ;

        $dummyPassword = fake()->password(8, 20) ;
        $is_exists = User::where('email', '=', $userEmail)->first() ;

        if($is_exists) {
            return redirect()->back()->withErrors(
                ['error' => 'User Already Exists!!.']);
        }

        $user = new User() ;
        $user->name = $userName ;
        $user->email = $userEmail ;
        $user->password = Hash::make($dummyPassword);
        $user->role = $userRole ;
        $user->save() ;

        
        $name = $user->name;
        //$dummyPassword = $user->password;
        $activationLink = route('accountActivation');
        $email = $user->email;
    
       
        //Mail::send(new SendActivationEmail($name, $dummyPassword, $activationLink, $email)) ;
        event(new UserCreated($name, $dummyPassword, $activationLink, $email)) ;
        //$user = Auth::user();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
             'user_name' => auth()->user()->name,
             'role' => 'Admin',
             'action' => 'New user Created!',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;

        if($request->role === 'Admin') {
           $user = User::where('email', '=', $userEmail)->first() ;
           $user->assignRole('Admin') ;
        }elseif($request->role === 'User'){
            $user = User::where('email', '=', $userEmail)->first() ;
            $user->assignRole('User') ;
        }elseif($request->role === 'Account Manager') {
            $user = User::where('email', '=', $userEmail)->first() ;
            $user->assignRole('Account Manager') ;
        }


        return redirect()->route('createUser')->with('message', 'New User Created Successfully!');

        //id, name, email, email_verified_at, password, remember_token, created_at, updated_at, is_active

    }


    public function showAccountActivation() {
        return view('accountActivation') ;
    }


    public function usersDataWithAccess() {
        $user = User::all() ;
        return view('admin_dashboard', compact('user')) ;
    }



}