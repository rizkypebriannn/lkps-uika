<?php

namespace App\Http\Controllers;

use App\Models\BebanKerjaDosen; // <-- WAJIB ADA
use Illuminate\Http\Request;

class BebanKerjaDosenController extends Controller
{
    public function index()
    {
        $dosens = BebanKerjaDosen::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('beban_kerja_dosen.index', compact('dosens'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        // AUTO-KALKULASI SKS SEBELUM DISIMPAN
        $data['sks_jumlah'] = $data['sks_ps_diakreditasi'] + $data['sks_ps_lain_dalam_pt'] + $data['sks_ps_lain_luar_pt'] + $data['sks_penelitian'] + $data['sks_pkm'] + $data['sks_tugas_tambahan'];
        $data['sks_rata_rata'] = $data['sks_jumlah'] / 2;

        BebanKerjaDosen::create($data);
        
        // Langsung kembali ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Beban Kerja Dosen berhasil disimpan!');
    }

    public function destroy($id)
    {
        BebanKerjaDosen::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data Beban Kerja Dosen berhasil dihapus!');
    }
}