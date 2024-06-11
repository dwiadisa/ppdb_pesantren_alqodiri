<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\CalonSantri;
use Illuminate\Http\Request;
use App\Validators\ValidatorRules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthenticateController extends Controller
{
    public function register(): View
    {
        return view('Auth.register');
    }
    public function register_action(Request $request): RedirectResponse
    {
        try {
            // validasi first
            $validator = ValidatorRules::registerRules($request->all());
            if ($validator->fails()) {
                return redirect('/register')->withErrors($validator)->withInput();
            }
            // validasi end

            $password1 = $request->password;
            $password2 = $request->password_confirm;

            // check password
            if ($password1 === $password2) {
                $data = $request->except('password_confirm');
                $data['level'] = "superadmin";
                $data['password'] = Hash::make($password1);

                // insert user
                User::registerUser($data);
                return redirect('/login')->with('success', 'Silahkan Login');
            } else {
                return redirect('/register')->with('failed', 'Terjadi Kesalahan');
            }
        } catch (\Exception $e) {
            return redirect('/register')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
    public function login(): View
    {
        return view('Auth.login');
    }
    public function login_action(Request $request): RedirectResponse
    {
        $validator = ValidatorRules::loginRules($request->all());
        if ($validator->fails()) {
            return redirect('/login')->withErrors($validator)->withInput();
        }


        $login = request()->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';
        request()->merge([$field => $login]);


        $credentetials = [
            $field => $login,
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentetials)) {
            // Jika sukses, redirect ke dashboard
            return redirect()->intended('/dashboard')->with('success', 'Selamat Datang ' . Auth::user()->name);
        } else {
            // Jika gagal, redirect kembali ke login dengan pesan error
            return redirect('/login')->with('failed', 'Username or Password is wrong!');
        }
    }
};
