<?php

use App\Http\Controllers\AppointmentRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ScheduleNoteController;
use App\Http\Controllers\Approval;
use App\Http\Controllers\Approval1;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\user_login;
use App\Models\Appointmentreq;
use App\Models\ScheduleNote;
use App\Models\StudentInfo;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/doctor/dashboard', function () {
    return view('doctor.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/view_app', function () {
    return view('view_app');
})->middleware(['auth', 'verified'])->name('view_app');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/patient_recs', function () {
    return view('patient_recs');
})->middleware(['auth', 'verified'])->name('patient_recs');

Route::get('/schedule', function () {
    return view('schedule');
})->middleware(['auth', 'verified'])->name('schedule');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/patient/dashboard', function () {
    return view('patient.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/nurse/dashboard', function () {
    return view('nurse.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


// Patient
Route::get('/patient/dashboard', function(){
    return view('Pages.patient');
})->name('patient-dashboard');

Route::get('/patient/profile', function(){
    return view('Pages.patient');
})->name('patient-profile');

Route::get('/patient/appointments', function(){
    return view('Pages.patient');
})->name('patient-view-appointment');

Route::get('/patient/request-appointment', function(){
    return view('Pages.patient');
})->name('patient-request-appointment');

Route::get('/patient/lab-results', function(){
    return view('Pages.patient');
})->name('patient-lab-results');

Route::get('/patient/about', function(){
    return view('Pages.patient');
})->name('patient-about');


// Nurse
Route::get('/nurse/home', function(){
    return view('Pages.nurse');
})->name('nurse-home');

Route::get('/nurse/profile', function(){
    return view('Pages.nurse');
})->name('nurse-profile');

Route::get('/nurse/appointment-request', function(){
    return view('Pages.nurse');
})->name('nurse-appointment-request');

Route::get('/nurse/confirmed-appointment', function(){
    return view('Pages.nurse');
})->name('nurse-confirmed-appointment');

Route::get('/nurse/schedule', function(){
    return view('Pages.nurse');
})->name('nurse-schedule');

Route::get('/nurse/report', function(){
    return view('Pages.nurse');
})->name('nurse-report');

//Doctor
Route::get('/doctor/home', function(){
    return view('Pages.doctor');
})->name('doctor-home');

Route::get('/doctor/profile', function(){
    return view('Pages.doctor');
})->name('doctor-profile');

Route::get('/doctor/appointment', function(){
    return view('Pages.doctor');
})->name('doctor-appointment');

Route::get('/doctor/patient-records', function(){
    return view('Pages.doctor');
})->name('doctor-patient-records');

Route::get('/doctor/schedule', function(){
    return view('Pages.doctor');
})->name('doctor-schedule');

//Announcement Storing
Route::resource('announcements', AnnouncementController::class);

//Appointment Request Storing
Route::resource('appointmentreqs', AppointmentRequest::class);

//Schedule Notes Storing
Route::get('/schedulenotes', [ScheduleNoteController::class, 'index'])->name('schedulenotes.index');
Route::resource('schedulenotes', ScheduleNoteController::class);

//Profile Update/Edit
Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');

//Approved appoinments storing
Route::post('/approval', [Approval::class, 'store'])->name('approval.store');
Route::post('/approval1/store', [Approval1::class, 'store'])->name('approval1.store');


//Report route
Route::get('/reports/weekly-patients', [ReportController::class, 'getWeeklyPatients'])->name('reports.weekly-patients');
Route::get('/reports/monthly-patients', [ReportController::class, 'getMonthlyPatients'])->name('reports.monthly-patients');
Route::get('/reports/patients-for-period', [ReportController::class, 'getPatientsForPeriod'])->name('reports.patients-for-period');

//Search route
Route::get('/search', [AppointmentController::class, 'search'])->name('search');


require __DIR__.'/auth.php';
