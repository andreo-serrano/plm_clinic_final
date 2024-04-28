<?php

use App\Http\Controllers\AppointmentRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\user_login;
use App\Models\Appointmentreq;
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

Route::post('/update-profile', [ProfileController::class, 'update']);

require __DIR__.'/auth.php';
