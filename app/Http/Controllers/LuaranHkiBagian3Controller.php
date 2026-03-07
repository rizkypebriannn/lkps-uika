<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiBagian3;
use Illuminate\Http\Request;

class LuaranHkiBagian3Controller extends Controller
{
    public function index()
    {
        $data = LuaranHkiBagian3::where('prodi_id', auth()->user()->prodi_id)->orderBy('tanggal', 'desc')->get();
        
        // PENTING: Panggil folder pakai UNDERSCORE (_)
        return view('luaran_hki_bagian3.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiBagian3::create($input);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Tabel 6.e.3-3 (Teknologi) berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranHkiBagian3::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.e.3-3 berhasil dihapus!');
    }
}