<?php

namespace App\Http\Controllers;

use App\Models\JenisObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisObatController extends Controller
{
    public function index()
    {
        $jenisObats = JenisObat::all();
        return view('be.jenis_obats.index', compact('jenisObats'));
    }

    public function create()
    {
        return view('be.jenis_obats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'deskripsi_jenis' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $image = $request->file('image_url');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('storage/jenis_obats'), $imageName);

        JenisObat::create([
            'jenis' => $request->jenis,
            'deskripsi_jenis' => $request->deskripsi_jenis,
            'image_url' => 'storage/jenis_obats/' . $imageName
        ]);

        return redirect()->route('jenis_obats.index')->with('success', 'Jenis Obat berhasil ditambahkan');
    }

    public function edit(JenisObat $jenisObat)
    {
        return view('be.jenis_obats.edit', compact('jenisObat'));
    }

    public function update(Request $request, JenisObat $jenisObat)
    {
        $request->validate([
            'jenis' => 'required',
            'deskripsi_jenis' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'jenis' => $request->jenis,
            'deskripsi_jenis' => $request->deskripsi_jenis,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($jenisObat->image_url && file_exists(public_path($jenisObat->image_url))) {
                unlink(public_path($jenisObat->image_url));
            }

            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('storage/jenis_obats'), $imageName);
            $data['image_url'] = 'storage/jenis_obats/' . $imageName;
        }

        $jenisObat->update($data);
        return redirect()->route('jenis_obats.index')->with('success', 'Jenis Obat berhasil diupdate');
    }

    public function destroy(JenisObat $jenisObat)
    {
        if ($jenisObat->image_url && file_exists(public_path($jenisObat->image_url))) {
            unlink(public_path($jenisObat->image_url));
        }

        $jenisObat->delete();
        return redirect()->route('jenis_obats.index')->with('success', 'Jenis Obat berhasil dihapus');
    }
}
