<?php

namespace App\Http\Controllers;

use App\Models\LuaranTeknologiProduk; 
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
        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tahun'        => 'required|numeric|min:2000|max:' . date('Y'),
            'keterangan'   => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranTeknologiProduk::create($validated);
        
        return redirect()->back()->with('success', 'Data Teknologi Tepat Guna & Produk berhasil disimpan!');
    }

    public function edit($id)
    {
        $produk = LuaranTeknologiProduk::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_teknologi_produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = LuaranTeknologiProduk::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tahun'        => 'required|numeric|min:2000|max:' . date('Y'),
            'keterangan'   => 'required|string',
        ]);

        $produk->update($validated);

        return redirect()->route('luaran_teknologi_produk.index')->with('success', 'Data Teknologi & Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = LuaranTeknologiProduk::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $produk->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}