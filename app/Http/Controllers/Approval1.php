<?php

namespace App\Http\Controllers;
use App\Models\Approvalmodel1;
use App\Models\Appointmentreq;
use App\Models\Labresults;

use Illuminate\Http\Request;

class Approval1 extends Controller
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
            'univnum' => 'nullable|string',
        ]);

        // Find the existing approval request by appid
        $approvalrequest = Approvalmodel1::where('appid', $validatedData['appointment_id'])->first();
        
        if (!$approvalrequest) {
            // If the approval request does not exist, create a new one
            $approvalrequest = new Approvalmodel1();
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

        // Create a new entry in Labresults table
        $this->createLabresultsEntry($validatedData);

        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Requested Successfully!');
    }

    private function createLabresultsEntry($validatedData)
    {
        // Ensure the necessary data is available and create a new Labresults entry
        $newLabResultData = [
            'appid' => $validatedData['appointment_id'],
            'univnum' =>  $validatedData['univnum'],
            'current_condition' => $validatedData['reqtype'],
            'diagnosis' => 'N/A',
            'treatment_plan' => 'N/A',
            'remarks' => $validatedData['remarks'] ?? 'N\A',
            'lab_results_file' => 'N/A',
        ];

        Labresults::create($newLabResultData);
    }
}
