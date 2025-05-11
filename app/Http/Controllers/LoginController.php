<?php
namespace app\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
use App\Models\MfaCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\MfaCodeMail;




class LoginController extends Controller
{

public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Generate MFA Code
        $code = rand(100000, 999999);
        MfaCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(60),
        ]);

        $data = ['mfa_code' => $code];

        Mail::raw('Your MFA code is: '.$code, function ($message) use($request) {
            $message->to($request->email)
                    ->subject('Mfa Code for Customer management');
        });

        Auth::logout(); 

        session(['mfa_user_id' => $user->id]);

        return redirect()->route('verify-mfa')->with('message', 'MFA code sent to your email.');
    }

    return back()->withErrors(['email' => 'Invalid credentials.']);
}

    public function showMfaForm()
    {

        return view('auth.verify-mfa');
    }

    public function verifyMfa(Request $request)
    {
    // $request->validate(['code' => 'required']);

        $userId = session('mfa_user_id');
        $mfaCode = MfaCode::where('user_id', $userId)
            ->where('code', $request->mfa_code)
            ->latest()
            ->first();

        if ($mfaCode) {
            Auth::loginUsingId($userId);
            session()->forget('mfa_user_id');
            return redirect('/dashboard')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['code' => 'Invalid or expired MFA code.']);
    }

    public function logout()
    {
        Auth::logout();  
        return redirect()->route('login');  
    }
}