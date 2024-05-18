<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleNote;
use Illuminate\Support\Facades\Auth;


class ScheduleNoteController extends Controller
{
    //

    public function index(Request $request)
    {
        $univNum = $request->input('univ_num');
        $scheduleNotes = ScheduleNote::where('univnum', $univNum)->get();
        return response()->json($scheduleNotes);
    }
    public function store(Request $request)
    {

        $scheduleNote = new ScheduleNote();

        $scheduleNote->univnum = Auth::user()->univ_num;
        $scheduleNote->todo_date = $request->input('todo_date'); 
        $scheduleNote->todo_title = $request->input('todo_title');
        $scheduleNote->todo_startTime = $request->input('todo_startTime');
        $scheduleNote->todo_endTime = $request->input('todo_endTime');
        // ... Set other fields ...
        $scheduleNote->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
        
    }


}
