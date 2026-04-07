<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiPaten; 
use Illuminate\Http\Request;

class LuaranHkiPatenController extends Controller
{
    public function index()
    {
        $hkis = LuaranHkiPaten::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('luaran_hki_paten.index', compact('hkis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tanggal'      => 'required|date',
            'nomor_paten'  => 'nullable|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiPaten::create($validated);
        
        // Tetap di halaman index
        return redirect()->back()->with('success', 'Data HKI Paten berhasil disimpan!');
    }

    public function edit($id)
    {
        $hki = LuaranHkiPaten::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_hki_paten.edit', compact('hki'));
    }

    public function update(Request $request, $id)
    {
        $hki = LuaranHkiPaten::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tanggal'      => 'required|date',
            'nomor_paten'  => 'nullable|string',
        ]);

        $hki->update($validated);

        return redirect()->route('luaran_hki_paten.index')->with('success', 'Data HKI Paten berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $hki = LuaranHkiPaten::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $hki->delete();
        
        return redirect()->back()->with('success', 'Data HKI Paten berhasil dihapus!');
    }
}