<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class AuthController extends Controller
{
    //FOR REGISTRATION / CREATING ACCOUNT
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        // validate user data
        $validated = request()->validate(
            [
                'name' => 'required|min:5|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );

        // create the user
        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' =>$validated['password'],
                // 'password' => Hash::make($validated['password']),
            ]
        );

        Mail::to($user->email)
            ->send(new WelcomeEmail($user));

        // redirect
        return redirect()->route('dashboard')->with('success', "Account Created Successfully!");
    }


    //FOR LOG IN ACCOUNT

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        // dd(request()->all());

        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if (auth()->attempt($validated)) {

            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', "Logged in Successfully!");
        }

        return redirect()->route('login')->withErrors([
            'email' => "No matching user found with the email provided and password. Try Again"
        ]);
    }

    //FOR LOG OUT ACCOUNT
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', "Account Logged Out!");
    }
}
