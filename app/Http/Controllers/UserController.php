<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'username' => $data['username'],
            'password' => $data['password'],
        ]);

        Auth::login($user);

        return redirect()->route('home');

    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'username' => 'Неверный логин или пароль.',
        ])->onlyInput('username');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function profile()
    {
        $userUrls = UserUrl::with('url')->where('user_id', Auth::id())->get();

        return view('user.profile', ['userUrls' => $userUrls]);
    }


}
