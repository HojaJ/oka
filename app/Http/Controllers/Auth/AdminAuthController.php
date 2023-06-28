<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if ( Auth::guard('web')->check() ) {
            return redirect()->route('dashboard');
        }else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'password' => 'required'
        // ]);

        if(auth()->guard('web')->attempt([
            'name'      => $request->name,
            'password'  => $request->password,
        ])){

            $user = auth()->user();
            return redirect()->intended(RouteServiceProvider::HOME);
        }else {
            return redirect()->back()->withErrors('Credentials doesn\'t match.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
