<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiBagian4;
use Illuminate\Http\Request;

class LuaranHkiBagian4Controller extends Controller
{
    public function index()
    {
        $data = LuaranHkiBagian4::where('prodi_id', auth()->user()->prodi_id)->orderBy('tanggal', 'desc')->get();
        return view('luaran_hki_bagian4.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiBagian4::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.e.3-4 (Buku/Book Chapter) berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranHkiBagian4::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.e.3-4 berhasil dihapus!');
    }
}