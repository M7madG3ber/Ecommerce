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

        return redirect()
            ->back()
            ->withInput()
            ->with(
                [
                    'type'  => 'danger',
                    'alert' => 'Credentials is not correct!'
                ]
            );
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
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Account registration failed, please try again!'
                    ]
                );
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

        return to_route('login')
            ->with(
                [
                    'type'  => 'primary',
                    'alert' => 'Check your mail inbox please.'
                ]
            );
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
            return to_route('login')
                ->with(
                    [
                        'type'  => 'danger',
                        'alert' => 'Expiration token!'
                    ]
                );
        }

        // Reset Password
        User::where("email", $request->email)
            ->update([
                'password' => bcrypt($request->password)
            ]);
        PasswordReset::where("email", $request->email)
            ->delete();

        return to_route('login')
            ->with(
                [
                    'type'  => 'success',
                    'alert' => 'Password reset successfully.'
                ]
            );
    }
}
