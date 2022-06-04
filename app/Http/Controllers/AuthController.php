<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function  __construct()
    {
        $this->middleware('guest');
    }

    public function registerView(){
        return view('auth.register');
    }

    public function loginView(){
        return view('auth.login');
    }

    public function login(Request $request)
    {

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back();
        } else {
            return redirect()->route('home');
        }
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required|min:3|max:255',
            'prenom' => 'required|min:3|max:255',
            'email' => 'required|string|min:5|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);
        $user =   User::create(
            [
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => bcrypt($request->password),

            ]
        );
        return redirect()->route('login');
    }
}
