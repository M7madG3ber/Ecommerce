<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $remember = $request->rememberme ? true : false;

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            if (auth()->user()->hasRole('admin'))
                return to_route('dashboard');
            else
                return to_route('home');
        }

        Session::flash('type', 'danger');
        Session::flash('alert', 'Credentials is not correct!');

        return redirect()
            ->back()
            ->withInput();
    }

    public function logout()
    {
        if (auth()->check())
            auth()->logout();

        return to_route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doRegister(RegisterRequest $request)
    {
        // Create user
        $user = User::create($request->except("_token"));

        if ($user == null) {
            Session::flash('type', 'danger');
            Session::flash('alert', 'Account registration failed, please try again!');

            return redirect()
                ->back()
                ->withInput();
        }

        // Get user role
        $role = Role::where("name", "user")->first();

        if ($role != null)
            $user->assignRole($role);

        return to_route('login');
    }

    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function doForgotPassword(ForgotPasswordRequest $request)
    {
        // generate token
        $token = Str::random(30);

        // Create password reset record
        PasswordReset::where("email", $request->email)
            ->delete();
        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Send email
        Mail::to($request->email)
            ->send(new ForgotPasswordMail($token));

        Session::flash('type', 'primary');
        Session::flash('alert', 'Check your mail inbox please.');
        return to_route('login');
    }

    public function resetPassword($token)
    {
        return view('auth.reset_password');
    }
    public function doResetPassword($token, ResetPasswordRequest $request)
    {
        $expiredTime = Carbon::now()
            ->subHours(2);

        $resetRecord = PasswordReset::where("email", $request->email)
            ->where("token", $token)
            ->where("created_at", ">=", $expiredTime)
            ->first();

        if ($resetRecord == null) {
            Session::flash('type', 'danger');
            Session::flash('alert', 'Expiration token!');
            return to_route('login');
        }

        // Reset Password
        User::where("email", $request->email)
            ->update([
                'password' => bcrypt($request->password)
            ]);
        PasswordReset::where("email", $request->email)
            ->delete();

        Session::flash('type', 'success');
        Session::flash('alert', 'Password reset successfully.');
        return to_route('login');
    }
}
