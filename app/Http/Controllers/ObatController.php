<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\JenisObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ObatController extends Controller
{
    public function index()
    {
        $obat = Obat::with('jenisObat')->orderBy('created_at', 'desc')->get();
        return view('be.obat.index', compact('obat'));
    }

    public function create()
    {
        $jenisObat = JenisObat::all();
        return view('be.obat.create', compact('jenisObat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'id_jenis' => 'required|exists:jenis_obats,id', // Sesuaikan dengan nama tabel
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'required',
            'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_obat' => $request->nama_obat,
            'id_jenis' => $request->id_jenis,  // Pastikan nama field sesuai
            'deskripsi_obat' => $request->deskripsi,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ];

        // Handle foto uploads
        foreach(['foto1', 'foto2', 'foto3'] as $foto) {
            if($request->hasFile($foto)) {
                $image = $request->file($foto);
                $imageName = $foto . '_' . time() . '.' . $image->extension();
                $image->move(public_path('storage/obat'), $imageName);
                $data[$foto] = $imageName;
            }
        }

        Obat::create($data);
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    public function show($id)
    {
        $obat = Obat::with('jenisObat')->findOrFail($id);
        return view('obat.show', compact('obat'));
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        $jenisObat = JenisObat::all();
        return view('be.obat.edit', compact('obat', 'jenisObat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'id_jenis' => 'required|exists:jenis_obats,id',
            'deskripsi_obat' => 'required',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $obat = Obat::findOrFail($id);
            $data = $request->except(['foto1', 'foto2', 'foto3']);

            // Handle file uploads
            foreach(['foto1', 'foto2', 'foto3'] as $foto) {
                if($request->hasFile($foto)) {
                    // Delete old file if exists
                    if ($obat->$foto && Storage::disk('public')->exists($obat->$foto)) {
                        Storage::disk('public')->delete($obat->$foto);
                    }

                    $path = $request->file($foto)->store('obat', 'public');
                    $data[$foto] = $path;
                }
            }

            $obat->update($data);

            DB::commit();
            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $obat = Obat::findOrFail($id);

            // Delete associated files
            foreach(['foto1', 'foto2', 'foto3'] as $foto) {
                if ($obat->$foto && Storage::disk('public')->exists($obat->$foto)) {
                    Storage::disk('public')->delete($obat->$foto);
                }
            }

            $obat->delete();

            DB::commit();
            return redirect()->route('obat.index')
                ->with('success', 'Data obat berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
