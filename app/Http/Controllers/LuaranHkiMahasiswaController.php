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
        $validated = $request->validate([
            'luaran_penelitian' => 'required|string',
            'tanggal'           => 'required|date',
            'status'            => 'required|in:Registered,Granted,Komersial',
            'nomor_registrasi'  => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiMahasiswa::create($validated);
        
        return redirect()->back()->with('success', 'Data HKI Mahasiswa berhasil disimpan!');
    }

    public function edit($id)
    {
        $hki = LuaranHkiMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_hki_mahasiswa.edit', compact('hki'));
    }

    public function update(Request $request, $id)
    {
        $hki = LuaranHkiMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'luaran_penelitian' => 'required|string',
            'tanggal'           => 'required|date',
            'status'            => 'required|in:Registered,Granted,Komersial',
            'nomor_registrasi'  => 'required|string',
        ]);

        $hki->update($validated);

        return redirect()->route('luaran_hki_mahasiswa.index')->with('success', 'Data HKI Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $hki = LuaranHkiMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $hki->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}