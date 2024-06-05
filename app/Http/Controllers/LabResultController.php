<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Labresults;

class LabResultController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the file
        $validatedData = $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // 2MB max
            'app_id' => 'required|string',
            'univnum' => 'nullable|string',
            'curr' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatplan' => 'nullable|string',
            'remarks' => 'nullable|string',

        ]);

        //dd($validatedData);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('laboratory_results',$fileName, 'public');

        // Set default values or null if the fields are empty
        $diagnosis = empty($validatedData['diagnosis']) ? 'N/A' : $validatedData['diagnosis'];
        $treatplan = empty($validatedData['treatplan']) ? 'N/A' : $validatedData['treatplan'];
        $remarks = empty($validatedData['remarks']) ? 'N/A' : $validatedData['remarks'];

        Labresults::create([
            'appid'=> $validatedData['app_id'],
            'univnum' =>  $validatedData['univnum'],
            'current_condition' =>  $validatedData['curr'],
            'diagnosis' => $diagnosis,
            'treatment_plan' =>  $treatplan,
            'remarks' =>  $remarks,
            'lab_results_file' => $filePath,
            // Add other relevant fields (e.g., patient_id, test_type)
        ]);

        return back()->with('success', 'Result uploaded successfully!');
    }
}
