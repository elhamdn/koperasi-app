<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\User;
use App\Models\Pengurus;
use App\Models\Anggota;


class AuthController extends Controller
{
    public function showFormLogin()
    {
        $checkAnggota = Auth::guard('anggota')->check();
        $checkPengurus = Auth::guard('pengurus')->check();
        if ($checkAnggota || $checkPengurus) {
            if ($checkAnggota) {
                $user = Auth::guard('anggota')->user();
                $id = Auth::guard('anggota')->id();
                return redirect()->to('/member/home');
            } else {
                $user = Auth::guard('pengurus')->user();
                $id = Auth::guard('pengurus')->id();
                return redirect()->to('/dashboard');
            }
        }
        return view('pages.login');
    }

    public function login(Request $request)
    {

        $anggota = Anggota::where('email', $request->input('email'))->first();
        $pengurus = Pengurus::where('email', $request->input('email'))->first();

        if ($pengurus) {
            if (Hash::check($request->input('password'), $pengurus->password)) {
                Auth::guard('pengurus')->login($pengurus);
            }
            if (Auth::guard('pengurus')->check()) {
                $id = Auth::id();
                return redirect()->to('/dashboard');
            } else {
                Session::flash('error', 'email atau password Pengurus salah');
                return redirect()->route('login');
            }
        } else if ($anggota) {
            if (Hash::check($request->input('password'), $anggota->password)) {
                Auth::guard('anggota')->login($anggota);
            }

            if (auth()->guard('anggota')->check()) {
                $id = Auth::id();
                $user = Auth::user();
                return redirect()->to('/home');
            } else {
                Session::flash('error', 'email atau Password Salah ');
                return redirect()->route('login');
            }
        } else {
            Session::flash('error', 'Masukan email atau Password');
            return redirect()->route('login');
        }
    }

    public function showFormRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed'
        ];

        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('login');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        if (Auth::guard('pengurus')->check()) {
            Auth::guard('pengurus')->logout();
        } else {
            Auth::guard('anggota')->logout();
        }
        return redirect()->route('login');
    }

    public function profile()
    {

        return view('pages.profile');
    }
}
