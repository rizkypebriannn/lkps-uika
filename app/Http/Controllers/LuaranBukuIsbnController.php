<?php

namespace App\Http\Controllers;

use App\Models\LuaranBukuIsbn; 
use Illuminate\Http\Request;

class LuaranBukuIsbnController extends Controller
{
    public function index()
    {
        $bukus = LuaranBukuIsbn::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('luaran_buku_isbn.index', compact('bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tanggal'      => 'required|date',
            'keterangan'   => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        LuaranBukuIsbn::create($validated);
        
        return redirect()->back()->with('success', 'Data Buku Ber-ISBN berhasil disimpan!');
    }

    public function edit($id)
    {
        $buku = LuaranBukuIsbn::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('luaran_buku_isbn.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = LuaranBukuIsbn::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'judul_luaran' => 'required|string',
            'tanggal'      => 'required|date',
            'keterangan'   => 'required|string',
        ]);

        $buku->update($validated);

        return redirect()->route('luaran_buku_isbn.index')->with('success', 'Data Buku Ber-ISBN berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $buku = LuaranBukuIsbn::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $buku->delete();
        
        return redirect()->back()->with('success', 'Data Buku Ber-ISBN berhasil dihapus!');
    }
}