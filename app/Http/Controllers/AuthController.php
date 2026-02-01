<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function register()
    {
        return view("auth.register");
    }

    public function verify(AuthRequest $request)
    {
        $data = $request->validated();

        if(Auth::guard("admin")->attempt(["email" => $data["email"], "password" => $data["password"], "role" => "admin"])) {
            $request->session()->regenerate();
            return redirect()->intended("admin/dashboard");
        } else if(Auth::guard("user")->attempt(["email" => $data["email"], "password" => $data["password"], "role" => "user"])) {
            $request->session()->regenerate();
            return redirect()->intended("/");
        } else {
            return redirect()->route("login")->with("error", "Email atau password salah");
        }
    }

    public function daftar(RegisterRequest $request)
    {
        $data = $request->validated();
        $data["role"] = "user";

        $user = User::create($data);
        
        if($user) {
            // Auth::guard("user")->attempt(["email" => $data["email"], "password" => $data["password"], "role" => "user"]);
            
            Auth::guard("user")->login($user);
            $request->session()->regenerate();
            
            return redirect()->intended("/");
        }
    }

    public function logout()
    {
        if(Auth::guard("admin")->check()) {
            Auth::guard("admin")->logout();
        } else if(Auth::guard("user")->check()) {
            Auth::guard("user")->logout();
        }

        return redirect()->route("index");
    }
}
