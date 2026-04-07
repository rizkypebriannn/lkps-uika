<?php

namespace App\Http\Controllers;

use App\Models\ProdukJasaDtps; 
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
        // Validasi data untuk mencegah null/error
        $validated = $request->validate([
            'nama_dtps'        => 'required|string',
            'nama_produk'      => 'required|string',
            'deskripsi_produk' => 'required|string',
            'bukti'            => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        ProdukJasaDtps::create($validated);
        
        // Tetap di halaman index
        return redirect()->back()->with('success', 'Data Produk/Jasa DTPS berhasil disimpan!');
    }

    public function edit($id)
    {
        $produk = ProdukJasaDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('produk_jasa_dtps.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = ProdukJasaDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dtps'        => 'required|string',
            'nama_produk'      => 'required|string',
            'deskripsi_produk' => 'required|string',
            'bukti'            => 'required|string',
        ]);

        $produk->update($validated);

        // Setelah update selesai, kembali ke tabel index
        return redirect()->route('produk_jasa_dtps.index')->with('success', 'Data Produk/Jasa DTPS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = ProdukJasaDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $produk->delete();
        
        // Tetap di halaman index
        return redirect()->back()->with('success', 'Data Produk/Jasa DTPS berhasil dihapus!');
    }
}