<?php

namespace App\Http\Controllers;

use App\Models\DokumenK3l; // <--- PENTING: Anti Class Not Found
use Illuminate\Http\Request;

class DokumenK3lController extends Controller
{
    public function index()
    {
        $dokumens = DokumenK3l::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('dokumen_k3l.index', compact('dokumens'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        DokumenK3l::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Dokumen K3L berhasil disimpan!');
    }

    public function destroy($id)
    {
        DokumenK3l::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}