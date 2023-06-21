<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Qruuid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function indexPage() {
        return view('index');
    }

    public function loginPage() {
        return view('auth.login');
    }

    public function registerPage() {
        return view('auth.register');
    }
    public function actionLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            if (auth()->user()->role == 'user') {
                return redirect()->route('dashboard');
            }
            elseif (auth()->user()->role == 'gate') {
                return redirect()->route('scanqr');
            }
            elseif (auth()->user()->role == 'admin') {
                return redirect()->route('admin.home');
            }
        }
        return redirect()->route('login')->with('error', 'Email atau Password Salah!');
    }
    public function actionRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'no_identitas' => 'required|unique:users,no_identitas',
            'platnomor' => 'required',
            'username' => 'required|unique:accounts,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_identitas' => $request->no_identitas,
            'platnomor' => $request->platnomor
        ]);
        Account::create([
            'id_user' => $user->id_user,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status' => 'active',
        ]);
        Qruuid::create([
            'id_user' => $user->id_user,
            'uuid_enter' => Str::uuid()->toString(),
        ]);

        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
