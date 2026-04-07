<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiHakCipta;
use Illuminate\Http\Request;

class LuaranHkiHakCiptaController extends Controller
{
    public function index()
    {
        $hkis = LuaranHkiHakCipta::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('luaran_hki_hak_cipta.index', compact('hkis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tanggal'      => 'required|date',
            'keterangan'   => 'nullable|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiHakCipta::create($validated);
        
        // Tetap di halaman index
        return redirect()->back()->with('success', 'Data HKI Hak Cipta & Desain berhasil disimpan!');
    }

    public function edit($id)
    {
        $hki = LuaranHkiHakCipta::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_hki_hak_cipta.edit', compact('hki'));
    }

    public function update(Request $request, $id)
    {
        $hki = LuaranHkiHakCipta::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tanggal'      => 'required|date',
            'keterangan'   => 'nullable|string',
        ]);

        $hki->update($validated);

        return redirect()->route('luaran_hki_hak_cipta.index')->with('success', 'Data HKI Hak Cipta berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $hki = LuaranHkiHakCipta::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $hki->delete();
        
        return redirect()->back()->with('success', 'Data HKI berhasil dihapus!');
    }
}