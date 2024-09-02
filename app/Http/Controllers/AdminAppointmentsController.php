<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAppointmentsController extends Controller
{

    //returns the list of appointments to admin
    public function showAppointmentsForAdmin(User $user) {

        //checks authroization model based policy
        $this->authorize('adminAppointmentsPageAccess', $user) ;

        $appointments = Appointment::paginate(3) ;
        $sortBy = 'created_at' ;
        $sortDirection = 'asc' ;
        return view('admin_view_appointments_page', compact('appointments', 'sortBy', 'sortDirection')) ;
    }

    //search results for list of appointments
    public function searchResultsForAppointments(Request $request) {
        $query = $request->input('query');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');
        $sortBy = $request->input('sort_by', 'created_at'); // Default sorting by created_at
        $sortDirection = $request->input('sort_direction', 'desc'); // Default sorting direction

        //applying the query to model
        $appointments = Appointment::query() ;


        if ($query) {
            $appointments = $appointments->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('attendees', ' LIKE', "%{$query}%") ;
            });
        }


        // Apply date range filter if present
        if ($dateFrom && $dateTo) {
            $appointments->whereBetween('start_date', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            $appointments->whereDate('start_date', '>=', $dateFrom);
        } elseif ($dateTo) {
            $appointments->whereDate('end_date', '<=', $dateTo);
        }


         // Apply sorting
        $appointments->orderBy($sortBy, $sortDirection);
        $appointments = $appointments->paginate(3) ;
        
        return view('admin_view_appointments_page', compact('appointments', 'sortBy', 'sortDirection'));
    }

    //returns appointment edit form
    public function showAppointmentEditForm(Request $request, $id) {
        $appointment = Appointment::findOrFail($id) ;
        return view('appointment_edit_form_for_admin', compact('appointment')) ;
    }

    //updates the appointments
    public function UpdateAppointmentForm(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'attendees' => 'required|string|max:255',
         
        ]);
    
        $appointment = Appointment::findOrFail($id);
        $appointment->title = $request->title ;
        $appointment->description = $request->description ;
        $appointment->start_date = $request->start_date ;
        $appointment->end_date = $request->end_date ;
        $appointment->location = $request->location ;
        $appointment->attendees = $request->attendees ;
        $appointment->save() ;

        //activity log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
             'user_name' => $user->name,
             'role' => $user->role,
             'action' => 'user updated appointment!',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;

        return redirect()->back()->with('success', 'Appointment updated successfully.');
    }


    //deletes the appointments
    public function deleteAppointment(Request $request, $id) {
        $appointment = Appointment::findOrFail($id) ;
        $appointment->delete() ;

        //activity log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user->id,
             'user_name' => $user->name,
             'role' => $user->role,
             'action' => 'user deleted appointment!',
             'ip_address' => request()->ip() ,
            'time' => now()
        ]) ;


        return redirect()->back()->with(['success' => 'Appointment Deleted Successfully!']) ;
    }
}
