<?php

namespace App\Http\Controllers;

use App\Models\LuaranTeknologiProduk; // <--- DIJAMIN AMAN
use Illuminate\Http\Request;

class LuaranTeknologiProdukController extends Controller
{
    public function index()
    {
        $produks = LuaranTeknologiProduk::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('luaran_teknologi_produk.index', compact('produks'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        LuaranTeknologiProduk::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Teknologi Tepat Guna & Produk berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranTeknologiProduk::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}