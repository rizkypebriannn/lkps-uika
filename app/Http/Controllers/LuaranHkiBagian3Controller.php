<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiBagian3;
use Illuminate\Http\Request;

class LuaranHkiBagian3Controller extends Controller
{
    public function index()
    {
        $data = LuaranHkiBagian3::where('prodi_id', auth()->user()->prodi_id)
                                ->orderBy('tanggal', 'desc')
                                ->get();
        
        return view('luaran_hki_bagian3.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'luaran_penelitian' => 'required|string',
            'tanggal'           => 'required|date',
            'status'            => 'required|string',
            'nomor_sertifikat'  => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiBagian3::create($validated);
        
        return redirect()->back()->with('success', 'Data Tabel 6.e.3-3 (Teknologi) berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = LuaranHkiBagian3::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_hki_bagian3.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = LuaranHkiBagian3::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'luaran_penelitian' => 'required|string',
            'tanggal'           => 'required|date',
            'status'            => 'required|string',
            'nomor_sertifikat'  => 'required|string',
        ]);

        $data->update($validated);

        return redirect()->route('luaran_hki_bagian3.index')->with('success', 'Data Tabel 6.e.3-3 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = LuaranHkiBagian3::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}