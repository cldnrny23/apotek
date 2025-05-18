<?php

namespace App\Http\Controllers;

use App\Models\MetodeBayar;
use Illuminate\Http\Request;

class MetodeBayarController extends Controller
{
    public function index()
    {
        $metodeBayars = MetodeBayar::all();
        return view('be.metode-bayars.index', compact('metodeBayars'));
    }

    public function create()
    {
        return view('be.metode-bayars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'format_bayar' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'required|string|max:255'
        ]);

        MetodeBayar::create($validated);
        return redirect()->route('metode-bayars.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    public function edit(MetodeBayar $metodeBayar)
    {
        return view('be.metode-bayars.edit', compact('metodeBayar'));
    }

    public function update(Request $request, MetodeBayar $metodeBayar)
    {
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|max:255',
            'format_bayar' => 'required|string|max:50',
            'no_rekening' => 'required|string|max:25',
            'url_logo' => 'required|string|max:255'
        ]);

        $metodeBayar->update($validated);
        return redirect()->route('metode-bayars.index')
            ->with('success', 'Metode pembayaran berhasil diperbarui');
    }

    public function destroy(MetodeBayar $metodeBayar)
    {
        $metodeBayar->delete();
        return redirect()->route('metode-bayars.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }
}
