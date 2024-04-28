<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\StudentInfo;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    /*public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }*/

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function update(Request $request)
    {
        $user = auth()->user(); // Get the authenticated user
        $studentInfo = $studentInfo = StudentInfo::where('studentID', $user->univ_num)->first();

        if ($studentInfo) {
            $studentInfo->peremail = $request->peremail;
            $studentInfo->mobnum = $request->mobnum;
            $studentInfo->guardmobnum = $request->gnum;

            $studentInfo->save();

            return response()->json(['message' => 'Profile updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Student information not found'], 404);
        }
    }

    /*public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'peremail' => 'required|string|max:255',
            'mobnum'   => 'required|int|max:11',
            'gnum'   => 'required|int|max:11'

            // Add validation rules for other fields here
        ]);

        // Retrieve the authenticated user's student info
        $studentInfo = StudentInfo::where('studentID', auth()->user()->univ_num)->first();

        if ($studentInfo) {
            // Update the student info with the validated data
            $studentInfo->update($validatedData);

            return response()->json(['message' => 'Profile updated successfully'], 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }*/

    
}
