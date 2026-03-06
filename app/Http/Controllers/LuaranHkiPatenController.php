<?php

namespace App\Http\Controllers;

use App\Models\LuaranHkiPaten; // <--- DIJAMIN AMAN DARI ERROR CLASS NOT FOUND
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
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        LuaranHkiPaten::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data HKI Paten berhasil disimpan!');
    }

    public function destroy($id)
    {
        LuaranHkiPaten::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data HKI Paten berhasil dihapus!');
    }
}