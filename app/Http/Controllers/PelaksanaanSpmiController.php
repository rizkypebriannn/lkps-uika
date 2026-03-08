<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaanSpmi;
use Illuminate\Http\Request;

class PelaksanaanSpmiController extends Controller
{
    public function index()
    {
        $data = PelaksanaanSpmi::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('created_at', 'asc')
                ->get();
                
        return view('pelaksanaan_spmi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        PelaksanaanSpmi::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 7.b (Pelaksanaan SPMI) berhasil disimpan!');
    }

    public function destroy($id)
    {
        PelaksanaanSpmi::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 7.b berhasil dihapus!');
    }
}