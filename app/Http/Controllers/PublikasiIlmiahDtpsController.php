<?php

namespace App\Http\Controllers;

use App\Models\PublikasiIlmiahDtps; // <--- DIJAMIN AMAN
use Illuminate\Http\Request;

class PublikasiIlmiahDtpsController extends Controller
{
    public function index()
    {
        $publikasis = PublikasiIlmiahDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('publikasi_ilmiah_dtps.index', compact('publikasis'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 
        
        // Auto-kalkulasi total publikasi
        $data['jumlah_total'] = $data['jumlah_ts2'] + $data['jumlah_ts1'] + $data['jumlah_ts'];

        PublikasiIlmiahDtps::create($data);
        
        // Langsung kembali ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Publikasi Ilmiah berhasil disimpan!');
    }

    public function destroy($id)
    {
        PublikasiIlmiahDtps::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data Publikasi Ilmiah berhasil dihapus!');
    }
}