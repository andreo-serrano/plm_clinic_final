<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Search extends Controller
{
    public function searchPatientRecords(Request $request)
    {
        $univsearch = $request->input('univsearch');

        $doctor_type = DB::table('doctorinfo')->where('doctorID', Auth::user()->univ_num)->first();

        if ($doctor_type->spec === 'Medical Doctor') {
            try {
                $medicalAppointmentIds = DB::table('appointmentreqs')
                    ->where('univnum', $univsearch)
                    ->where('remarks', 'Approved')
                    ->where('type', 'Medical')
                    ->pluck('id');
                
                $medicalrecord = DB::table('appointmentreqs')
                    ->where('univnum', $univsearch)
                    ->where('remarks', 'Approved')
                    ->where('type', 'Medical')
                    ->get();

                if ($medicalAppointmentIds->isEmpty()) {
                    return response()->json(['records' => [], 'message' => 'No medical appointments found']);
                }

                $records = DB::table('labresults')
                    ->whereIn('appid', $medicalAppointmentIds)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $nameLookup = $this->fetchNames($records->pluck('univnum'));

                $records = $records->map(function ($record) {
                    $record->publicPath = asset('storage/' . $record->lab_results_file);
                    return $record;
                });

                return response()->json([
                    'records' => $records,
                    'medicalrecord'  => $medicalrecord,
                    'nameLookup' => $nameLookup,
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
            }
        } else {
            try {
                $dentalAppointmentIds = DB::table('appointmentreqs')
                    ->where('univnum', $univsearch)
                    ->where('remarks', 'Approved')
                    ->where('type', 'Dental')
                    ->pluck('id');

                if ($dentalAppointmentIds->isEmpty()) {
                    return response()->json(['records' => [], 'message' => 'No dental appointments found']);
                }

                $records = DB::table('labresults')
                    ->whereIn('appid', $dentalAppointmentIds)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $nameLookup = $this->fetchNames($records->pluck('univnum'));

                $records = $records->map(function ($record) {
                    $record->publicPath = asset('storage/' . $record->lab_results_file);
                    return $record;
                });

                return response()->json([
                    'records' => $records,
                    'nameLookup' => $nameLookup,
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
            }
        }
    }

    private function fetchNames($univNums)
    {
        return DB::table('studentinfo')
            ->select('studentID as univnum', 'lastname', 'firstname', 'midname')
            ->whereIn('studentID', $univNums)
            ->union(
                DB::table('employeeinfo')
                    ->select('employeeID as univnum', 'lastname', 'firstname', 'midname')
                    ->whereIn('employeeID', $univNums)
            )
            ->union(
                DB::table('facultyinfo')
                    ->select('facultyID as univnum', 'lastname', 'firstname', 'midname')
                    ->whereIn('facultyID', $univNums)
            )
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    (string) $item->univnum => [
                        'lastname' => $item->lastname,
                        'firstname' => $item->firstname,
                        'midname' => $item->midname,
                    ]
                ];
            })
            ->toArray();
    }

    public function updateRecord(Request $request)
    {
        // Log the request data for debugging
        //\Log::info('Update Request:', $request->all());

        // Retrieve data from the request
        $appid = $request->input('appid');
        //$currentCondition = $request->input('curr');
        $diagnosis = $request->input('diag');
        $treatmentPlan = $request->input('treat');
        $remarks = $request->input('rem');

        //dd($appid);
        //dd($remarks);

        // Perform database update
        $affected = DB::table('labresults')
                      ->where('appid', $appid)
                      ->update([
                          //'current_condition' => $currentCondition,
                          'diagnosis' => $diagnosis,
                          'treatment_plan' => $treatmentPlan,
                          'remarks' => $remarks,
                      ]);

        // Log the result of the update for debugging
       // \Log::info('Update Result:', ['affected' => $affected]);

        if ($affected) {
            return redirect()->back()->with('success', 'Requested Successfully!');
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update record']);
        }
    }
}
