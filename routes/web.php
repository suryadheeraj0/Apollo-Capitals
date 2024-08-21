<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRolesController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('create-user', [AdminController::class, 'createUser'])->name('createUser') ; 

Route::post('store-user', [AdminController::class, 'store'])->name('storeUser') ;

Route::get('account-activation', [AdminController::class, 'showAccountActivation'])->name('accountActivation') ;

Route::post('store-activated-user', [AdminController::class, 'validateAndSaveUser'])->name('storeActivatedUser') ;


//surya routes
Route::resource('admin', AdminRolesController::class);

Route::get('admi',[AdminController::class,'usersDataWithAccess'])->name('admi');

/*

Route::get('assign_roles',function(){
    if (!Role::where('name', 'Admin')->exists()) {
        $role1 = Role::create(['name' => 'Admin']);
    } else {
        $role1 = Role::where('name', 'Admin')->first();
    }
 
    if (!Role::where('name', 'Account_Manager')->exists()) {
        $role2 = Role::create(['name' => 'Account_Manager']);
    } else {
        $role2 = Role::where('name', 'Account_Manager')->first();
    }
});
    if (!Role::where('name', 'User')->exists()) {
        $role3 = Role::create(['name' => 'User']);
    } else {
        $role3 = Role::where('name', 'User')->first();
    }
 
    // Check and create permissions if they do not exist
    if (!Permission::where('name', 'create_role')->exists()) {
        $permission1 = Permission::create(['name' => 'create_role']);
    } else {
        $permission1 = Permission::where('name', 'create_role')->first();
    }
 
    if (!Permission::where('name', 'edit_role')->exists()) {
        $permission2 = Permission::create(['name' => 'edit_role']);
    } else {
        $permission2 = Permission::where('name', 'edit_role')->first();
    }
 
    if (!Permission::where('name', 'delete_role')->exists()) {
        $permission3 = Permission::create(['name' => 'delete_role']);
    } else {
        $permission3 = Permission::where('name', 'delete_role')->first();
    }
    $role1->givePermissionTo($permission1);
    $role1->givePermissionTo($permission2);
    $role1->givePermissionTo($permission3);
 
    $role2->givePermissionTo($permission2);
    $role2->givePermissionTo($permission3);
 
    $role3->givePermissionTo($permission2);
 
    dd('success');

*/