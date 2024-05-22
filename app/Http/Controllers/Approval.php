<?php

namespace App\Http\Controllers;
use App\Models\Approvalmodel;
use App\Models\Appointmentreq;

use Illuminate\Http\Request;

class Approval extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'appointment_id' => 'required|string|max:255',
            'usertype' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'reqtype' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        // Find the existing approval request by appid
        $approvalrequest = Approvalmodel::where('appid', $validatedData['appointment_id'])->first();
        
        if (!$approvalrequest) {
            // If the approval request does not exist, create a new one
            $approvalrequest = new Approvalmodel();
            $approvalrequest->appid = $validatedData['appointment_id'];
            $approvalrequest->type = $validatedData['usertype'];
            $approvalrequest->date = $validatedData['date'];
            $approvalrequest->time = $validatedData['time'];
            $approvalrequest->patient_concern = $validatedData['reqtype'];
            $approvalrequest->remarks = $validatedData['remarks'];
        } else {
            // Update the existing approval request with new data
            $approvalrequest->type = $validatedData['usertype'];
            $approvalrequest->date = $validatedData['date'];
            $approvalrequest->time = $validatedData['time'];
            $approvalrequest->patient_concern = $validatedData['reqtype'];
            $approvalrequest->remarks = $validatedData['remarks'];
        }

        if ($request->input('action') === 'resolved') {
            $approvalrequest->status = "Resolved";
        } else if ($request->input('action') === 'accept') {
            $approvalrequest->status = "Approved";
        } else if ($request->input('action') === 'cancel') {
            $approvalrequest->status = "Reschedule";
        }

        // Save the Requested Appointment to the database
        $approvalrequest->save();

        // Update the appointment status in the Appointmentreq table
        $updatereq = Appointmentreq::where('id', $validatedData['appointment_id'])->first();

        if ($updatereq) {
            // Update the necessary fields in the other table
            $updatereq->remarks = $approvalrequest->status;

            // Save the changes to the other table
            $updatereq->save();
        }

        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Requested Successfully!');
    
    }
}
