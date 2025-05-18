<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\AuthFe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class AuthFeController extends Controller
{
    public function signin()
    {
        return view('auth.loginfe');
    }

    public function signup()
    {
        return view('auth.registerfe');
    }

    public function registerPelanggan(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'no_telp' => 'required|string|max:20',
            'katakunci' => 'required|min:8|max:12',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'katakunci' => Hash::make($request->katakunci),
            'alamat1' => '-',
            'kota1' => '-',
            'propinsi1' => '-',
            'kodepos1' => '-',
            'foto' => 'default.jpg',
        ]);

        // Authenticate the user
        Auth::guard('pelanggan')->login($pelanggan);

        // Set session variables
        $request->session()->put('loginId', $pelanggan->id);
        $request->session()->put('pelanggan_name', $pelanggan->nama_pelanggan);
        $request->session()->put('pelanggan_email', $pelanggan->email);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function loginPelanggan(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string', // Ubah dari 'email' ke 'name'
            'katakunci' => 'required',
        ]);

        // Cari pelanggan berdasarkan nama
        $pelanggan = Pelanggan::where('nama_pelanggan', $credentials['name'])->first();

        // Jika pelanggan tidak ditemukan atau password salah
        if (!$pelanggan || !Hash::check($credentials['katakunci'], $pelanggan->katakunci)) {
            return back()->withErrors([
                'name' => 'The provided credentials do not match our records.',
            ]);
        }

        // Login pelanggan
        Auth::guard('pelanggan')->login($pelanggan);

        $request->session()->regenerate();
        $request->session()->put('loginId', $pelanggan->id);
        $request->session()->put('pelanggan_name', $pelanggan->nama_pelanggan);

        return redirect()->intended(route('home'));
    }
    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->forget('loginId');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('loginfe')->with('success', 'Logout berhasil');
    }
}
