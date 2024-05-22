<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AppointmentConfirmation;
use DB;

class AppointmentController extends Controller
{
    public function search(Request $request)
    {
        $searchInput = $request->input('searchInput');

        $appointments = AppointmentConfirmation::where('univnum', 'like', '%' . $searchInput . '%')
            ->where('remarks', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('search_results', compact('appointments'));
    }
}
