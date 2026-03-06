<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiMahasiswa;
use Illuminate\Http\Request;

class LuaranHkiMahasiswaController extends Controller
{
    public function index()
    {
        $hkis = LuaranHkiMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tanggal', 'desc')
                    ->get();
        return view('luaran_hki_mahasiswa.index', compact('hkis'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiMahasiswa::create($data);
        
        return redirect('/dashboard')->with('success', 'Data HKI Mahasiswa berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranHkiMahasiswa::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}