<?php

namespace App\Http\Controllers;

use App\Models\PenelitianDtpsMahasiswa;
use Illuminate\Http\Request;

class PenelitianDtpsMahasiswaController extends Controller
{
    public function index()
    {
        $data = PenelitianDtpsMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun', 'desc')
                ->get();
                
        return view('penelitian_dtps_mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        PenelitianDtpsMahasiswa::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.h.1 (Penelitian DTPS & Mahasiswa) berhasil disimpan!');
    }

    public function destroy($id)
    {
        PenelitianDtpsMahasiswa::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.h.1 berhasil dihapus!');
    }
}