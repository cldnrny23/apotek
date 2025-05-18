<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\JenisObat;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Obat::with('jenisObat')->where('stok', '>', 0)->paginate(10);
        $categories = JenisObat::all();

        return view('fe.produk.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $products = Obat::with('jenisObat')->findOrFail($id);
        $relatedProducts = Obat::where('jenis_obat_id', $product->jenis_obat_id)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        return view('fe.produk.show', compact('product', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $products = Obat::with('jenisObat')
                    ->when($query, function($q) use ($query) {
                        return $q->where('nama_obat', 'like', "%$query%");
                    })
                    ->when($category, function($q) use ($category) {
                        return $q->where('jenis_obat_id', $category);
                    })
                    ->where('stok', '>', 0)
                    ->paginate(10);

        $categories = JenisObat::all();

        return view('fe.produk.index', compact('products', 'categories'));
    }
}
