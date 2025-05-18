<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAuth
{
    public function handle(Request $request, Closure $next, ...$jabatan)
    {
        if (Auth::check()) {
            $userjabatan = Auth::user()->jabatan;

            if (!in_array($userjabatan, $jabatan)) {
                switch ($userjabatan) {
                    case 'admin':
                        return redirect('/admin');
                    case 'apoteker':
                        return redirect('/apoteker');
                    case 'pemilik':
                        return redirect('/pemilik');
                    case 'karyawan':
                        return redirect('/karyawan');
                    case 'kasir':
                        return redirect('/kasir');
                    default:
                        return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
