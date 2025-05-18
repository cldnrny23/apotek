<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::with('jenisPengiriman')->latest()->paginate(10);
        return view('be.pengiriman.index', compact('pengirimans'));
    }

    public function create()
    {
        $penjualans = Penjualan::all();
        return view('be.pengiriman.create', compact('penjualans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penjualan' => 'required',
            'no_invoice' => 'required|unique:pengirimans',
            'tgl_kirim' => 'required|date',
            'status_kirim' => 'required',
            'nama_kurir' => 'required|max:30',
            'telpon_kurir' => 'required|max:15',
            'bukti_foto' => 'nullable|image|max:2048'
        ]);

        $pengiriman = new Pengiriman($request->all());

        if ($request->hasFile('bukti_foto')) {
            $file = $request->file('bukti_foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengiriman'), $filename);
            $pengiriman->bukti_foto = $filename;
        }

        $pengiriman->save();
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('be.pengiriman.edit', compact('pengiriman'));
    }

    public function update(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        $request->validate([
            'id_penjualan' => 'required',
            'no_invoice' => 'required|unique:pengirimans,no_invoice,' . $id,
            'tgl_kirim' => 'required|date',
            'status_kirim' => 'required',
            'nama_kurir' => 'required|max:30',
            'telpon_kurir' => 'required|max:15',
            'bukti_foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('bukti_foto')) {
            // Delete old image
            if ($pengiriman->bukti_foto) {
                unlink(public_path('uploads/pengiriman/' . $pengiriman->bukti_foto));
            }

            $file = $request->file('bukti_foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pengiriman'), $filename);
            $pengiriman->bukti_foto = $filename;
        }

        $pengiriman->update($request->except('bukti_foto'));
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil diupdate');
    }

    public function destroy($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        if ($pengiriman->bukti_foto) {
            unlink(public_path('uploads/pengiriman/' . $pengiriman->bukti_foto));
        }
        $pengiriman->delete();
        return redirect()->route('pengiriman.index')->with('success', 'Pengiriman berhasil dihapus');
    }
}
