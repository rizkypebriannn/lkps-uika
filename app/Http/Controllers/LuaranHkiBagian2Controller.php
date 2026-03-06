<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiBagian2;
use Illuminate\Http\Request;

class LuaranHkiBagian2Controller extends Controller
{
    public function index()
    {
        // Ambil data sesuai prodi
        $data = LuaranHkiBagian2::where('prodi_id', auth()->user()->prodi_id)->get();
        
        // PANGGIL PAKAI STRIP (-) SESUAI NAMA FOLDER ANDA
        return view('luaran-hki-bagian2.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiBagian2::create($input);
        
        // Auto-Redirect ke Dashboard sesuai standar Anda
        return redirect('/dashboard')->with('success', 'Data HKI Bagian 2 berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranHkiBagian2::findOrFail($id)->delete();
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data HKI Bagian 2 berhasil dihapus!');
    }
}