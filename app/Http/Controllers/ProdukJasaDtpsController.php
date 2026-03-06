<?php

namespace App\Http\Controllers;

use App\Models\ProdukJasaDtps; // <--- DIJAMIN AMAN
use Illuminate\Http\Request;

class ProdukJasaDtpsController extends Controller
{
    public function index()
    {
        $produks = ProdukJasaDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('produk_jasa_dtps.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        ProdukJasaDtps::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Produk/Jasa DTPS berhasil disimpan!');
    }

    public function destroy($id)
    {
        ProdukJasaDtps::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}