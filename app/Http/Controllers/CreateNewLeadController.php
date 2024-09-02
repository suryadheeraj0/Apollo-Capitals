<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\NewLead;
use Illuminate\Http\Request;

class CreateNewLeadController extends Controller
{

    //returns a view to show all the leads and it is user specific
    public function showAllLeads() {
        $leads = NewLead::where('user_id', auth()->user()->id) ;
        $leads = $leads->paginate(3) ;
        return view('show_all_leads_page', compact('leads')) ;
    }

    //returns a from to create a new lead
    public function showCreateLeadForm() {
        return view('create_newlead_form') ;
    }

    //stores and validates the newly created lead
    public function storeLeadDetails(Request $request) {

        $request->validate([
            'name' => 'required' ,
            'email' => 'required|email' ,
            'address' => 'required' ,
            'phone_number' => 'required' ,
            'lead_status' => 'required' ,
        ]) ;

        $name = $request->name ;
        $email = $request->email ;
        $address = $request->address ;
        $phone_number = $request->phone_number ;
        $lead_status = $request->lead_status ;
        $user_id = auth()->user()->id ;

        $newLead = NewLead::where('email', $email)->first() ;
        if($newLead) {
            return redirect()->back()->with(['message' => 'Email already Existed']) ;
        }

        $newLead = NewLead::create([
            'name' => $name ,
            'email' => $email ,
            'address' => $address ,
            'phone_number' => $phone_number ,
            'lead_status' => $lead_status ,
            'user_id' => $user_id ,
        ]);

        return redirect()->back()->with(['message' => 'New Lead Created Successfully!']) ;

    }

    //edit form for lead to update
    public function showEditForm(Request $request, $id) {
        $lead = NewLead::findOrFail($id) ;
        return view('show_lead_edit_form', compact('lead')) ;
    }

    //updating the lead details
    public function updateLead(Request $request, $id) {
        $request->validate([
            'name' => 'required' ,
            'email' => 'required|email' ,
            'address' => 'required' ,
            'phone_number' => 'required' ,
            'lead_status' => 'required' ,
        ]) ;

        $name = $request->name ;
        $email = $request->email ;
        $address = $request->address ;
        $phone_number = $request->phone_number ;
        $lead_status = $request->lead_status ;
        $user_id = auth()->user()->id ;
        
        $lead = NewLead::findOrFail($id) ; 

        //if it is convert to customer we will add it to the customer model
        if($lead_status == '3') {
            Customer::create([
                'user_id' => auth()->user()->id
                , 'name' => $name
                , 'email' =>$email
                , 'phone_number' =>$phone_number
                , 'address' => $address
            ]) ; 
            $lead->delete() ; 
        } else {
        $lead->name =  $name  ;
        $lead->email =$email  ;
        $lead->address = $address  ;
        $lead->phone_number = $phone_number ;
        $lead->lead_status = $lead_status ;
        $lead->save() ;
        }
        
        return redirect()->route('leads.index')->with('message', 'Lead Updated Successfully') ;
    }


    //deletes the lead
    public function destroyLead(Request $request, $id) {
        $lead = NewLead::findOrFail($id) ;
        $lead->delete() ;
        return redirect()->back()->with(['message' => 'Lead Deleted Successfully!']) ;
    }

}
