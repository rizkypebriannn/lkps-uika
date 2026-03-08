<?php

namespace App\Http\Controllers;

use App\Models\KepuasanPenggunaLulusan;
use Illuminate\Http\Request;

class KepuasanPenggunaLulusanController extends Controller
{
    public function index()
    {
        $data = KepuasanPenggunaLulusan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kepuasan_pengguna_lulusan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        KepuasanPenggunaLulusan::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.g.2 (Kepuasan Pengguna) berhasil disimpan!');
    }

    public function destroy($id)
    {
        KepuasanPenggunaLulusan::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.g.2 berhasil dihapus!');
    }
}