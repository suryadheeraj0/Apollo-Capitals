<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class HomeDashboardController extends Controller
{
    //returns user home dashboard
    public function index()
    {
        $user=auth()->user();
        return view('user_home',compact('user'));
    }
 
}