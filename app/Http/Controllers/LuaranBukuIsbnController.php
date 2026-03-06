<?php

namespace App\Http\Controllers;

use App\Models\LuaranBukuIsbn; // <--- DIJAMIN AMAN
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
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        LuaranBukuIsbn::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Buku Ber-ISBN berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranBukuIsbn::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data Buku Ber-ISBN berhasil dihapus!');
    }
}