<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('be.profile_user.index', [
            'title' => 'User Profile',
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(session('loginId'));
        $path = $user->foto;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'no_hp' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($request->hasFile('foto')){
            // Hapus foto lama jika ada
            if($user->foto && Storage::exists($user->foto)){
                Storage::delete($user->foto);
            }

            $path = $request->file('foto')->store('profile_images');
            $user->foto = $path;
        }

        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Profil berhasil diperbarui')
            ->with('newImage', asset('storage/'.$path));
    }
}
