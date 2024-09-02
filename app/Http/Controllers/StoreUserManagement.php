<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Task;
use App\Models\Appointment;
use App\Models\User;

class StoreUserManagement extends Controller
{
    public function create_task(Request $request)
    {
        $user=auth()->user();
        $request->validate([
            'task' => 'required|string|max:140',
            'description' => 'nullable|string|max:255',
            'due_date' => 'required|date',
            'priority' => 'required|string',
        ]);
        $task=new Task();
        $task->task=$request->task;
        $task->user_id=$user->id;
        $task->description=$request->description;
        $task->due_date_time=$request->due_date;
        $task->priority=$request->priority;
        $task->status=1;
        $task->assigned_to=0;
        $task->save();
 
        return redirect()->route('show.create',$user->id);
    }
 
    /*public function showCustomers(){
        $customers = Customer::all();
        return view('user_home.create_cust',compact('customers'));
    }*/
    public function showCreateCustomerForm()
    {
        $user = auth()->user();
        return view('user_home.create_cust_data', compact('user'));
    }
 
    public function create_cust(Request $request)
    {
 
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);
 
        $user = auth()->user();
        $existingCustomer = Customer::where('email', $validatedData['email'])->first();

        if ($existingCustomer) {
            // Handle the case where the email already exists
            return redirect()->route('create_cust_data1')->with(['message' => 'This email is already taken.']);
        } else {
            // Proceed with the insertion
            $customer = new Customer();
            $customer->name = $validatedData['name'];
            $customer->email = $validatedData['email'];
            $customer->phone_number = $validatedData['phone'];
            $customer->address = $validatedData['address'];
            $customer->user_id = $user->id;
            $customer->save();
 
            return redirect()->route('create_cust_data1')->with('message', 'Customer added successfully!');
        }

    }
    public function edit_task($id)
    {
       $task = Task::findOrFail($id);
       $users = User::all() ;
       return view('user_home.edit_tasks', compact('task', 'users'));
    }

    /*
    public function update_task(Request $request, $id)
    {
       $task = Task::findOrFail($id);
       $user=auth()->user();
       $user_id=$user->id;
       $task->task=$request->task;
       $task->user_id=$user->id;
       $task->description=$request->description;
       $task->due_date_time=$request->due_date_time;
       $task->priority=$request->priority;
       $task->status=$request->status;
       $task->assigned_to=0;
       $task->save();
      return redirect()->route('show.index')->with('success', 'Task updated successfully!');
    }*/

    public function update_task(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|string',
        ]);
     
        $task = Task::findOrFail($id);
        $currentUser = auth()->user();
        $task->status = $request->status;
        /*if ($request->assign_to !== 'None' && $request->assign_to) {
            $assignedUser = User::where('id', $request->assign_to)
                                ->where('role', 'user')
                                ->where('id', '!=', $currentUser->id)
                                ->first();
     
            if ($assignedUser) {
                $task->user_id = $assignedUser->id;
                $task->assigned_to = $assignedUser->id;
            }
        } else {
            $task->user_id = $currentUser->id;
            $task->assigned_to = 0;
        }*/
     
        $task->save();
     
        return redirect()->route('show.index')->with('success', 'Task updated successfully!');
    }
    
     
 
    public function delete_task(string $id){
        $task=Task::findOrFail($id);
        $task->delete();
        return redirect()->route('show.index');
    }

 
    public function create_the_appointment(Request $request)
    {
 
       $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'location' => 'nullable|string|max:255',
        'attendees' => 'nullable|string',
        'customer_id' => 'required|exists:customers,id',
        'task_id' => 'nullable|exists:tasks,id',
       ]);
 
 
        $appointment = new Appointment();
        $appointment->title = $validatedData['title'];
        $appointment->user_id=auth()->user()->id;
        $appointment->description = $validatedData['description'];
        $appointment->start_date = $validatedData['start_date'];
        $appointment->end_date = $validatedData['end_date'];
        $appointment->location = $validatedData['location'];
        $appointment->attendees = $validatedData['attendees'];
        $appointment->customer_id = $validatedData['customer_id'];
        $appointment->task_id = $validatedData['task_id'];
 
        $appointment->save();
 
        return redirect()->route('create_customer_appointment');
    }
 
    public function update_the_appointment(Request $request,string $id){
        $appointment=Appointment::findOrFail($id);
        $appointment->title = $request->title;
        $appointment->description = $request->description;
        $appointment->start_date =$request->start_date;
        $appointment->end_date = $request->end_date;
        $appointment->location = $request->location;
        $appointment->attendees = $request->attendees;
        $appointment->customer_id = $request->customer_id;
        $appointment->task_id = $request->task_id;
 
        $appointment->save();
 
        return redirect()->route('show_customer_appointment');
    }


    public function delete_the_appointment(string $id)
    {
        $appointment=Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->route('show_customer_appointment');
    }
 
    public function update_customer(Request $request,string $id){
        $customer=Customer::findOrFail($id);
        $customer->name=$request->name;
        $customer->email=$request->email;
        $customer->phone_number=$request->phone_number;
        $customer->save();
        return redirect()->back()->with(['message' => 'Customer details Updated Successfully!']) ;
    }


    public function delete_customer(Request $request,string $id){
        $customer=Customer::findOrFail($id);
        $customer->delete();
        return redirect()->back()->with(['message' => 'Task Deleted Successfully!']) ;
    }
}
 