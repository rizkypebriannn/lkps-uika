<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiHakCipta; // <--- PENTING AGAR TIDAK ERROR
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
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiHakCipta::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data HKI Hak Cipta & Desain berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranHkiHakCipta::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data HKI berhasil dihapus!');
    }
}