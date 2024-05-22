<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\StudentInfo;
use App\Models\EmployeeInfo;
use App\Models\FacultyInfo;
use App\Models\NurseInfo;
use App\Models\DoctorInfo;


class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'peremail' => 'required|email',
            'mobnum' => 'required',
            'gnum' => 'required',
        ]);

        // Update student profile
        if (StudentInfo::where('studentID', Auth::user()->univ_num)->first()) {
            $this->updateProfileByType('student', $request);
        }

        // Update employee profile if applicable
        if (EmployeeInfo::where('employeeID', Auth::user()->univ_num)->first()) {
            $this->updateProfileByType('employee', $request);
        }

        // Update faculty profile if applicable
        if (FacultyInfo::where('facultyID', Auth::user()->univ_num)->first()) {
            $this->updateProfileByType('faculty', $request);
        }

        // Update nurse profile if applicable
        if (NurseInfo::where('nurseID', Auth::user()->univ_num)->first()) {
            $this->updateProfileByType('nurse', $request);
        }

        // Update nurse profile if applicable
        if (DoctorInfo::where('doctorID', Auth::user()->univ_num)->first()) {
            $this->updateProfileByType('doctor', $request);
        }
        
        // Redirect back or wherever you need
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

    private function updateProfileByType($type, $request)
    {
        switch ($type) {
            case 'student':
                $userInfo = StudentInfo::where('studentID', Auth::user()->univ_num)->first();
                if ($userInfo) {
                    $userInfo->peremail = $request->input('peremail');
                    $userInfo->mobnum = $request->input('mobnum');
                    $userInfo->guardmobnum = $request->input('gnum');
                    $userInfo->save();
                }
                break;
            case 'employee':
                $userInfo = EmployeeInfo::where('employeeID', Auth::user()->univ_num)->first();
                if ($userInfo) {
                    $userInfo->peremail = $request->input('peremail');
                    $userInfo->mobnum = $request->input('mobnum');
                    $userInfo->emergencymobnum = $request->input('gnum');
                    $userInfo->save();
                }
                break;
            case 'faculty':
                $userInfo = FacultyInfo::where('facultyID', Auth::user()->univ_num)->first();
                if ($userInfo) {
                    $userInfo->peremail = $request->input('peremail');
                    $userInfo->mobnum = $request->input('mobnum');
                    $userInfo->emergencymobnum = $request->input('gnum');
                    $userInfo->save();
                }
                break;
            case 'nurse':
                $userInfo = NurseInfo::where('nurseID', Auth::user()->univ_num)->first();
                if ($userInfo) {
                    $userInfo->peremail = $request->input('peremail');
                    $userInfo->mobnum = $request->input('mobnum');
                    $userInfo->ermobnum = $request->input('gnum');
                    $userInfo->save();
                }
                break;
            case 'doctor':
                $userInfo = DoctorInfo::where('doctorID', Auth::user()->univ_num)->first();
                if ($userInfo) {
                    $userInfo->peremail = $request->input('peremail');
                    $userInfo->mobnum = $request->input('mobnum');
                    $userInfo->ermobnum = $request->input('gnum');
                    $userInfo->save();
                }
                break;
        }
    }
}
