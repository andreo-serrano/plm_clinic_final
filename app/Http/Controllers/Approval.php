<?php

namespace App\Http\Controllers;

use App\Models\Approvalmodel;
use App\Models\Appointmentreq;
use App\Models\Labresults;
use Illuminate\Http\Request;

class Approval extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'appointment_id' => 'required|string|max:255',
            'usertype' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'time' => 'required|string|max:255',
            'reqtype' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'univnum' => 'nullable|string',
        ]);

        // Handle Approvalmodel creation or update
        $approvalrequest = Approvalmodel::updateOrCreate(
            ['appid' => $validatedData['appointment_id']],
            [
                'type' => $validatedData['usertype'],
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'patient_concern' => $validatedData['reqtype'],
                'remarks' => $validatedData['remarks'],
                'status' => $this->determineStatus($request->input('action'))
            ]
        );

        // Update Appointmentreq table
        $updatereq = Appointmentreq::where('id', $validatedData['appointment_id'])->first();

        if ($updatereq) {
            $updatereq->remarks = $approvalrequest->status;
            $updatereq->save();
        }

        // Create a new entry in Labresults table
        $this->createLabresultsEntry($validatedData);

        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Requested Successfully!');
    }

    private function determineStatus($action)
    {
        switch ($action) {
            case 'resolved':
                return 'Resolved';
            case 'accept':
                return 'Approved';
            case 'cancel':
                return 'Reschedule';
            default:
                return 'Pending';
        }
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
