<?php

namespace App\Http\Controllers;

use App\Models\KinerjaDtps; // <--- DIJAMIN AMAN
use Illuminate\Http\Request;

class KinerjaDtpsController extends Controller
{
    public function index()
    {
        $kinerjas = KinerjaDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kinerja_dtps.index', compact('kinerjas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 
        
        // Auto-kalkulasi Jumlah Publikasi
        $data['jumlah_publikasi'] = $data['jumlah_ts2'] + $data['jumlah_ts1'] + $data['jumlah_ts'];

        KinerjaDtps::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Kinerja DTPS berhasil disimpan!');
    }

    public function destroy($id)
    {
        KinerjaDtps::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}