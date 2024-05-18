<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointmentreq;


class AppointmentRequest extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'appreq_type' => 'required|string|max:255',
            'appreq_univnum' => 'required|string|max:255',
            'reqtype' => 'sometimes|required|string|max:255', 
            'appreq_reason' => 'nullable|string',
            'appreq_date' => 'required|string|max:255',
            'appreq_time' => 'required|string|max:255',
            
        ]);

        // Create a new Appointment Request model instance
        $appointmentrequest = new Appointmentreq();
        
        // Set the Appointment Request to its designated fields from the request
        $appointmentrequest->type = $validatedData['appreq_type'];
        $appointmentrequest->univnum = $validatedData['appreq_univnum'];
       // Set reqtype to 'none' when Dental is selected, otherwise use the validated data
        if ($request->input('appreq_type') === 'Medical') {
            $appointmentrequest->request_type = $validatedData['reqtype'];
        } else {
            $appointmentrequest->request_type = 'N/A'; // Explicitly set to "none"
        }
        $appointmentrequest->reason = $validatedData['appreq_reason'] ?? 'N/A'; 
        $appointmentrequest->date = $validatedData['appreq_date'];
        $appointmentrequest->time = $validatedData['appreq_time'];

        // Save the Requested Appointment to the database
        $appointmentrequest->save();

        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Requested Successfully!');
    }
}
