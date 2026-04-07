<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiBagian4;
use Illuminate\Http\Request;

class LuaranHkiBagian4Controller extends Controller
{
    public function index()
    {
        $data = LuaranHkiBagian4::where('prodi_id', auth()->user()->prodi_id)
                                ->orderBy('tanggal', 'desc')
                                ->get();
        return view('luaran_hki_bagian4.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'luaran_penelitian' => 'required|string',
            'tanggal'           => 'required|date',
            'nomor_isbn'        => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiBagian4::create($validated);
        
        return redirect()->back()->with('success', 'Data Tabel 6.e.3-4 (Buku/Book Chapter) berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = LuaranHkiBagian4::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_hki_bagian4.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = LuaranHkiBagian4::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'luaran_penelitian' => 'required|string',
            'tanggal'           => 'required|date',
            'nomor_isbn'        => 'required|string',
        ]);

        $data->update($validated);

        return redirect()->route('luaran_hki_bagian4.index')->with('success', 'Data Tabel 6.e.3-4 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = LuaranHkiBagian4::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 6.e.3-4 berhasil dihapus!');
    }
}