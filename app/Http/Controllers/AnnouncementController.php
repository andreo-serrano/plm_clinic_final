<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'announcement_title' => 'required|string|max:255',
            'announcement_date' => 'required|string|max:255',
            'announcement_details' => 'required|string',
            'announcement_provider' => 'nullable|string|max:500',
            
        ]);

        // Create a new Announcement model instance
        $announcement = new Announcement();
        
        // Set the announcement title from the request
        $announcement->title = $validatedData['announcement_title'];
        $announcement->date = $validatedData['announcement_date'];
        $announcement->details = $validatedData['announcement_details'];
        $announcement->provider = $validatedData['announcement_provider'];

        // Save the announcement to the database
        $announcement->save();

        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Announcement created successfully!');
    }
}
