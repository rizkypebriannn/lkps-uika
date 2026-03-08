<?php

namespace App\Http\Controllers;

use App\Models\DokumenSpmi;
use Illuminate\Http\Request;

class DokumenSpmiController extends Controller
{
    public function index()
    {
        $data = DokumenSpmi::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('created_at', 'asc')
                ->get();
                
        return view('dokumen_spmi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        DokumenSpmi::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 7.a (Dokumen SPMI) berhasil disimpan!');
    }

    public function destroy($id)
    {
        DokumenSpmi::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 7.a berhasil dihapus!');
    }
}