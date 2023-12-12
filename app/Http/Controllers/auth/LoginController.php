<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginFormRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store(LoginFormRequest $request) {

        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'no_login'=>'Неккоректный логин или пароль!'
            ]);
        };

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy() {
        Auth::logout();
        return redirect()->route('login');
    }
}
