<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Models\Verifies;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);

         // Authentication will be performed after code verification
        if ($this->checkcode($request)) {
            $request->authenticate();
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()->route('login');
    }

public function sendcode(Request $request)
{
    try {
        $characters = '0123456789';
        $code = '';

        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }

        $verifies = new Verifies();
        $verifies->email = $request->email;
        $verifies->code = $code;
        $verifies->save();

        Mail::send('mail.sendcode', ['content' => ['code' => $code]], function ($message) use ($request) {
            $message->to($request->email)->subject('Verification Code');
        });

        return Response::json(['message' => 'Verification code sent successfully']);
    } catch (\Exception $e) {
        // Log the exception or handle the error as needed
        return Response::json(['error' => 'Failed to send verification code'], 500);
    }
}

    public function checkcode(Request $request): bool
    {
        // Assuming your code field is in the request
        $code = $request->code;

        $verifiesexist = Verifies::where('email', $request->email)->where('code', $request->code)->latest()->first();

        if(!$verifiesexist){
            return false;
        }

        $resetCreatedAt = Carbon::parse($verifiesexist['created_at']);
        $currentDateTime = Carbon::now();

        if($currentDateTime->greaterThan($resetCreatedAt->addMinutes(10))){
            return false;
        }else{
            return true;
        }
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
