<?php

namespace App\Http\Controllers;
use App\Models\Patient; 
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getWeeklyPatients(Request $request)
    {
        $patients = Patient::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();
        return response()->json($patients);
    }

    public function getMonthlyPatients(Request $request)
    {
        $patients = Patient::whereMonth('created_at', now()->month)->get();
        return response()->json($patients);
    }

    public function getPatientsForPeriod(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $patients = Patient::whereBetween('created_at', [$start_date, $end_date])->get();
        return response()->json($patients);
    }

}
