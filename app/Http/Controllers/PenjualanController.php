<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\MetodeBayar;
use App\Models\JenisPengiriman;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $metodeBayars = MetodeBayar::all();
        $jenisPengirimans = JenisPengiriman::all();
        $pelanggans = Pelanggan::all();
        $penjualans = Penjualan::with(['metodeBayars', 'jenisPengirimans', 'pelanggans'])->get();
        return view('be.penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $metodeBayars = MetodeBayar::all();
        $jenisPengirimans = JenisPengiriman::all();
        $pelanggans = Pelanggan::all();
        return view('be.penjualans.create', compact('metodeBayars', 'jenisPengirimans', 'pelanggans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_metode_bayar' => 'required|exists:metode_bayars,id',
            'tgl_penjualan' => 'required|date',
            'url_resep' => 'nullable|string',
            'ongkos_kirim' => 'required|numeric',
            'biaya_app' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'status_order' => 'required|in:Menunggu Konfirmasi,Diproses,Menunggu Kurir,Dibatalkan Pembeli,Dibatalkan Penjual,Bermasalah,Selesai',
            'keterangan_status' => 'nullable|string',
            'id_jenis_kirim' => 'required|exists:jenis_pengirimans,id',
            'id_pelanggan' => 'required|exists:pelanggans,id',
        ]);

        Penjualan::create($validated);
        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil ditambahkan');
    }

    public function edit(Penjualan $penjualan)
    {
        $metodeBayars = MetodeBayar::all();
        $jenisPengirimans = JenisPengiriman::all();
        $pelanggans = Pelanggan::all();
        return view('be.penjualans.edit', compact('penjualan', 'metodeBayars', 'jenisPengirimans', 'pelanggans'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $validated = $request->validate([
            'id_metode_bayar' => 'required|exists:metode_bayars,id',
            'tgl_penjualan' => 'required|date',
            'url_resep' => 'nullable|string',
            'ongkos_kirim' => 'required|numeric',
            'biaya_app' => 'required|numeric',
            'total_bayar' => 'required|numeric',
            'status_order' => 'required',
            'keterangan_status' => 'nullable|string',
            'id_jenis_kirim' => 'required|exists:jenis_pengirimans,id',
            'id_pelanggan' => 'required|exists:pelanggans,id',
        ]);

        $penjualan->update($validated);
        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil diperbarui');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil dihapus');
    }
}
