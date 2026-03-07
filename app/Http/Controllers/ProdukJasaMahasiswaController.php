<?php

namespace App\Http\Controllers;

use App\Models\ProdukJasaMahasiswa;
use Illuminate\Http\Request;

class ProdukJasaMahasiswaController extends Controller
{
    public function index()
    {
        $data = ProdukJasaMahasiswa::where('prodi_id', auth()->user()->prodi_id)->latest()->get();
        // Memanggil view dengan format garis bawah (_)
        return view('produk_jasa_mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        ProdukJasaMahasiswa::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.e.4 (Produk/Jasa Mahasiswa) berhasil disimpan!');
    }

    public function destroy($id)
    {
        ProdukJasaMahasiswa::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.e.4 berhasil dihapus!');
    }
}