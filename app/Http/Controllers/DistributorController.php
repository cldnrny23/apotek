<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = Distributor::all();
        return view('be.distributors.index', compact('distributors'));
    }

    public function create()
    {
        return view('be.distributors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_distributor' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        Distributor::create($request->all());
        return redirect()->route('distributors.index')->with('success', 'Distributor berhasil ditambahkan');
    }

    public function edit($id)
    {
        $distributor = Distributor::findOrFail($id);
        return view('be.distributors.edit', compact('distributor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_distributor' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $distributor = Distributor::findOrFail($id);
        $distributor->update($request->all());

        return redirect()->route('distributors.index')
            ->with('success', 'Distributor berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            $distributor = Distributor::findOrFail($id);
            $distributor->delete();
            return redirect()->route('distributors.index')
                ->with('success', 'Distributor berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('distributors.index')
                ->with('error', 'Gagal menghapus distributor');
        }
    }
}
