<?php
 
namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Customer;
use App\Models\Task;
use Illuminate\Http\Request;
 
class ShowUserManagement extends Controller
{

    //task assigned to user page 
    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->get();
        //info($user_id) ;
        $sortBy = 'created_at' ;
        $sortDirection = 'desc' ;

        return view('user_home.user_tasks', compact('tasks', 'sortBy', 'sortDirection'));
    }

    //results for task assigned to user page
    public function indexSearchResults(Request $request) {
        $query = $request->input('query');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $priority = $request->input('priority');
        $status = $request->input('status');
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at
        $sortDirection = $request->input('sort_direction', 'desc'); // Default sorting direction
    
    
        // Start a query builder instance for Post
        $tasks = Task::query();
    
        // Apply search query if present
        if ($query) {
            $tasks = $tasks->where(function ($q) use ($query) {
                $q->where('task', 'LIKE', "%{$query}%")
                  ->orWhereHas('user', function ($q) use ($query) {
                      $q->where('name', 'LIKE', "%{$query}%");
                  });
            });
        }
    
        // Apply date range filter if present
        if ($dateFrom && $dateTo) {
            $tasks->whereBetween('created_at', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $tasks->whereDate('created_at', '>=', $dateFrom);
        } elseif ($dateTo) {
            $tasks->whereDate('created_at', '<=', $dateTo);
        }
    
    
        // Apply priority filter if present
        if ($priority) {
            $tasks->where('priority', $priority);
        }
    
  
        if ($status) {
            $tasks->where('status', $status);
        }
        $tasks->orderBy($sortBy, $sortDirection);
        $tasks = $tasks->paginate(10); 

        return view('user_home.user_tasks', compact('tasks', 'sortBy', 'sortDirection')) ;
    
    }


 
    public function create(Request $request, string $id)
    {
        $user=auth()->user();
        $customers=Customer::all();
        return view('user_home.task', compact('user','customers'));
    }
 
    public function show_appoint(){
        $user=auth()->user();
        return view('user_home.cust_appoint',compact('user'));
    }
 
    public function create_appoint(){
        $user=auth()->user();
        $appointment=Appointment::all();
        return view('user_home.create_cust_appoint',compact('user','appointment'));
    }



    public function create_cust(){
        $user=auth()->user();
        $customers=Customer::all();
        $sortBy = 'created_at' ;
        $sortDirection = 'desc' ;
        return view('user_home.create_cust',compact('user','customers', 'sortBy', 'sortDirection'));
    }


    //search results for create_cust
    public function searchresultsforcreatecust(Request $request) {
        $query = $request->input('query');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $priority = $request->input('priority');
        $status = $request->input('status');
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at
        $sortDirection = $request->input('sort_direction', 'desc'); // Default sorting direction
    
    
        // Start a query builder instance for Post
        $customers = Customer::query();
    
        // Apply search query if present
        if ($query) {
            $customers = $customers->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('email', 'LIKE', "%{$query}%") ;
            });
        }
    
        // Apply date range filter if present
        if ($dateFrom && $dateTo) {
            $customers->whereBetween('created_at', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $customers->whereDate('created_at', '>=', $dateFrom);
        } elseif ($dateTo) {
            $customers->whereDate('created_at', '<=', $dateTo);
        }
    
    
        // Apply priority filter if present
        if ($priority) {
            $customers->where('priority', $priority);
        }
    
  
        if ($status) {
            $customers->where('status', $status);
        }
        $customers->orderBy($sortBy, $sortDirection);
        $customers = $customers->paginate(10); 

        return view('user_home.create_cust', compact('customers', 'sortBy', 'sortDirection')) ;
    }


    public function create_cust_data(){
        $customer=Customer::all();
        return view('user_home.create_cust_data',compact('customer'));
    }
    public function create_customer_appointment(){
        $customers=Customer::all();
        $tasks=Task::all();
        return view('user_home.create_customer_appointment',compact('customers','tasks'));
    }



    public function show_appointments(){
        $user=auth()->user()->id;
        $appointments=Appointment::where('user_id', $user)->get() ;
        return view('user_home.show_appoint',compact('appointments'));
    }



    
    public function edit_appointment(Request $request,string $id){
        $appointment=Appointment::findOrFail($id);
        $customers=Customer::all();
        $tasks=Task::all();
        return view('user_home.edit_appoint',compact('appointment','customers','tasks'));
    }
    public function edit_customers(Request $request,string $id){
        $customer=Customer::findOrFail($id);
        return view('user_home.edit_customer',compact('customer'));
    }
}
 