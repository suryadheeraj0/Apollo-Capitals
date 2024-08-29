<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminAppointmentsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\AdminTaskController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\HomeDashboardController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowUserManagement;
use App\Http\Controllers\StoreUserManagement;
use App\Http\Controllers\TasksAssignmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use Illuminate\Routing\RouteRegistrar;
use Spatie\Permission\Models\Role;



;


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


//route for welcome page which is not protectd 

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


//dashboard 
Route::get('/dashboard', function () {
    $user = auth()->user() ;
    return view('user_home', compact('user'));
})->middleware(['auth', 'verified', 'otp.verified'])->name('dashboard');




//Routes which are protected by auth middleware 
Route::middleware(['auth', 'otp.verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/otp/verify', [OtpController::class, 'show'])->name('otp.verify');
    Route::post('/otp/verify', [OtpController::class, 'verify']);

    Route::post('/otp/request', [OtpController::class, 'requestNewOtp'])
    ->middleware('throttle:otp-request')
    ->name('otp.request');

    Route::post('/profile/enable-mfa', [ProfileController::class, 'enableMfa'])->name('profile.enableMfa');
    Route::post('/profile/disable-mfa', [ProfileController::class, 'disableMfa'])->name('profile.disableMfa');


    //Route For User Inactivity 
    Route::post('/extend-session', function () {
        if (Auth::check()) {
            // Optionally, you can implement additional checks or actions here
            return response()->json(['status' => 'success']);
         }
        return response()->json(['status' => 'error']);
    })->name('extend-session');


    Route::post('/update-inactivity-status', function () {
        session(['inactivity_popup' => true]);
        return response()->json(['message' => 'Inactivity status updated']);
    })->middleware('auth');
    //end of user inactivity routes

});

require __DIR__.'/auth.php'; 



Route::middleware(['auth', 'otp.verified'])->group(function(){

    Route::get('/get', [SearchController::class, 'searchPostsWithComments'])->name('posts.search') ;

    Route::get('/search-page', [SearchController::class, 'searchPage']) ;   

    //user management routes

    Route::get('create-user', [AdminController::class, 'createUser'])->name('createUser') ; 

    Route::post('store-user', [AdminController::class, 'store'])->name('storeUser') ;

    Route::get('account-activation', [AdminController::class, 'showAccountActivation'])->name('accountActivation') ;

    Route::post('store-activated-user', [AdminController::class, 'validateAndSaveUser'])->name('storeActivatedUser') ;


    //surya routes

    //Route::get('admi',[AdminController::class,'usersDataWithAccess'])->name('admi');

    Route::resource('roles-management', AdminRolesController::class)->names([
        'index' => 'roles.index',      // Route to list all tasks
    ]);



    //Route for users list with thier access for admin 

    Route::get('users-list-with-access', [SearchController::class, 'showUsersList']) ;
    Route::get('users-list-with-access-filters', [SearchController::class, 'searchUser'])->name('users.search') ;




    //surya routes 
    Route::get('home', [HomeDashboardController::class, 'index'])->name('home');
 
    Route::get('/show', [ShowUserManagement::class, 'index'])->name('show.index');
    Route::get('/show/create/{id}', [ShowUserManagement::class, 'create'])->name('show.create');
    Route::get('show_appoint', [ShowUserManagement::class, 'show_appoint'])->name('show_appoint');
    Route::get('create_appoint', [ShowUserManagement::class, 'create_appoint'])->name('create_appoint');
    Route::get('create_cust', [ShowUserManagement::class, 'create_cust'])->name('create_cust1');
    Route::get('create_cust_data', [ShowUserManagement::class, 'create_cust_data'])->name('create_cust_data1');
 
 
    Route::get('/tasks', [TasksAssignmentController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create/{id}', [TasksAssignmentController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store/{id}', [TasksAssignmentController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/store1/{id}', [TasksAssignmentController::class, 'store1'])->name('tasks.store1');
    Route::get('/tasks/edit/{id}', [TasksAssignmentController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/update/{id}', [TasksAssignmentController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/destroy/{id}', [TasksAssignmentController::class, 'destroy'])->name('tasks.destroy');
 
 
    Route::get('/customers/create', [StoreUserManagement::class, 'showCreateCustomerForm'])->name('create_cust_data');
    Route::get('/customers/create_data', [StoreUserManagement::class, 'showCustomers'])->name('create_cust');
    Route::post('/customers/store', [StoreUserManagement::class, 'create_cust'])->name('customers.store');
 
    Route::post('tasks/create', [StoreUserManagement::class, 'create_task'])->name('store.create_task');
    Route::get('store/edit/{id}', [StoreUserManagement::class, 'edit_task'])->name('store.edit_task');
    Route::put('store/update/{id}', [StoreUserManagement::class, 'update_task'])->name('store.update_task');
 
    Route::delete('store/delete/{id}',[StoreUserManagement::class,'delete_task'])->name('store.delete_task');
 
 
 
 
    Route::get('/admin/roles', [AdminRolesController::class, 'index'])->name('admin.index');
 
 
    Route::get('/admin/roles/create', [AdminRolesController::class, 'create'])->name('admin.create');
 
 
    Route::post('/admin/roles', [AdminRolesController::class, 'store'])->name('admin.store');
 
 
    Route::get('/admin/roles/{id}/edit', [AdminRolesController::class, 'edit'])->name('admin.edit');
 
 
    Route::put('/admin/roles/{id}', [AdminRolesController::class, 'update'])->name('admin.update');
 
    Route::delete('/admin/roles/{id}', [AdminRolesController::class, 'destroy'])->name('admin.destroy');
 
    //route for admin dashboard
    Route::get('admin', [AdminController::class, 'showAdminPage'])->name('admin_dashboard');
 
 
    Route::get('create_appointment',[ShowUserManagement::class,'create_customer_appointment'])->name('create_customer_appointment');
 
    Route::get('back',function(){
        return redirect('home');
    })->name('back');
 
    Route::post('store_customer_appointment',[StoreUserManagement::class,'create_the_appointment'])->name('store_customer_appointment');
 
    Route::get('show_customer_appointment',[ShowUserManagement::class,'show_appointments'])->name('show_customer_appointment');
 
    Route::get('edit_appointment/{id}',[ShowUserManagement::class,'edit_appointment'])->name('edit_appointment');
 
    Route::put('update_appointment/{id}',[StoreUserManagement::class,'update_the_appointment'])->name('update_appointment');
 
    Route::delete('delete_appointment/{id}',[StoreUserManagement::class,'delete_the_appointment'])->name('delete_appointment');
 
    Route::get('edit_customers/{id}',[ShowUserManagement::class,'edit_customers'])->name('edit_customer');
 
    Route::put('update_customers/{id}',[StoreUserManagement::class,'update_customer'])->name('update_customer');
 
    Route::delete('delete_customer/{id}',[StoreUserManagement::class,'delete_customer'])->name('delete_customer');
 


    //route for admin create task search 
    Route::get('admin-create-task-search', [SearchController::class, 'searchUserForTaskCreation'])->name('users-search-task-creation');



    //routes for admin view customers 
    Route::get('view-customers-for-admin', [SearchController::class, 'showCustomersToAdmin'])->name('view-customers-for-admin') ;

    //route for to delete a user 
    Route::delete('delete-user/{userId}', [DeleteController::class, 'deleteUser'])->name('delete-user') ;

    //route for assignments to admin
    Route::get('view-appointments-for-admin', [AdminAppointmentsController::class, 'showAppointmentsForAdmin'])->name('view-appointments-for-admin') ;
    Route::get('get-search-results-for-appointments', [AdminAppointmentsController::class, 'searchResultsForAppointments'])->name('get-search-results-for-appointments') ;
    Route::get('show-edit-form-to-edit-appointment-admin/{appointmentId}', [AdminAppointmentsController::class, 'showAppointmentEditForm'])->name('show-edit-form-to-edit-appointment-admin') ;
    Route::put('appointment/{id}',[AdminAppointmentsController::class, 'UpdateAppointmentForm'])->name('appointments.update');
    Route::delete('delete-appointment-admin/{appointmentId}', [AdminAppointmentsController::class, 'deleteAppointment'])->name('delete-appointment-admin') ;


    //Routes for to view the task 
    Route::get('view-tasks-for-admin', [AdminTaskController::class, 'showTasks'])->name('view-tasks-for-admin') ;
    Route::get('get-search-tasks-results', [AdminTaskController::class, 'showTasksSearchResults'])->name('get-search-tasks-results') ;
    Route::get('edit-task-form-admin/{taskId}', [AdminTaskController::class, 'showEditForm'])->name('edit-task-form-admin') ;
    Route::put('update-task-for-admin/{taskId}', [AdminTaskController::class, 'updateTask'])->name('update-task-for-admin') ;
    Route::delete('delete-task/{taskId}', [AdminTaskController::class, 'deleteTask'])->name('delete-task') ;

    //Routes for show activity logs 

    Route::get('show-activity-logs-admin', [ActivityLogController::class, 'showActivityLogToAdmin'])->name('show-activity-logs-admin') ;
    Route::get('show-activity-log-user', [ActivityLogController::class, 'showActivityLogToUser'])->name('show-activity-logs-user') ;


    //routes for creating permissions
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');


    //routes for task assigned to user page and search results for it 
    Route::get('users-task-search-results', [ShowUserManagement::class, 'indexSearchResults'])->name('userTasks.results') ;
    
    //routes for search customers for users
    Route::get('users-customers-results', [ShowUserManagement::class, 'searchresultsforcreatecust'])->name('usersCustomers.results') ;

}) ;