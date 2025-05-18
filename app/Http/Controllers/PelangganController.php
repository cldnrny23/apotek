<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('be.pelanggans.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('be.pelanggans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggans,email',
            'no_telp' => 'required|string|max:20',
            'katakunci' => 'required|string|min:6',
            'alamat1' => 'required|string',
            'kota1' => 'required|string|max:100',
            'kodepos1' => 'required|string|max:10',
            'alamat2' => 'nullable|string',
            'kota2' => 'nullable|string|max:100',
            'kodepos2' => 'nullable|string|max:10',
            'alamat3' => 'nullable|string',
            'kota3' => 'nullable|string|max:100',
            'kodepos3' => 'nullable|string|max:10',
        ]);

        // Enkripsi kata kunci sebelum disimpan
        $validated['katakunci'] = bcrypt($validated['katakunci']);

        Pelanggan::create($validated);

        return redirect()->route('pelanggans.index')
                         ->with('success', 'Pelanggan berhasil ditambahkan');
    }
    public function show(Pelanggan $pelanggan)
    {
        return view('be.pelanggans.show', compact('pelanggan'));
    }
    public function edit(Pelanggan $pelanggan)
    {
        return view('be.pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required',
            'email' => 'required|email|unique:pelanggans,email,'.$pelanggan->id,
            'no_telp' => 'required',
            'katakunci' => 'required',
            'alamat1' => 'required',
            'kota1' => 'required',
            'kodepos1' => 'required',
            'alamat2' => 'nullable',
            'alamat3' => 'nullable',
            'kota2' => 'nullable',
            'kota3' => 'nullable',
            'kodepos2' => 'nullable',
            'kodepos3' => 'nullable',
        ]);

        $pelanggan->update($validated);
        return redirect()->route('pelanggans.index')->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggans.index')->with('success', 'Data pelanggan berhasil dihapus');
    }
}
