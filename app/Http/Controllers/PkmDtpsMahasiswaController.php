<?php

namespace App\Http\Controllers;

use App\Models\PkmDtpsMahasiswa;
use Illuminate\Http\Request;

class PkmDtpsMahasiswaController extends Controller
{
    public function index()
    {
        $data = PkmDtpsMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun', 'desc')
                ->get();
                
        return view('pkm_dtps_mahasiswa.index', compact('data'));
    }

   public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        // TRICK SAKTI: Jika input nama_mahasiswa berupa array (lebih dari 1),
        // gabungkan menjadi satu string dengan pemisah koma (, )
        if (isset($input['nama_mahasiswa']) && is_array($input['nama_mahasiswa'])) {
            $input['nama_mahasiswa'] = implode(', ', $input['nama_mahasiswa']);
        }

        PkmDtpsMahasiswa::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.i (PkM DTPS & Mahasiswa) berhasil disimpan!');
    }

public function destroy($id)
    {
        PkmDtpsMahasiswa::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.i berhasil dihapus!');
    }
}