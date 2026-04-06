<?php

namespace App\Http\Controllers;

use App\Models\BebanKerjaDosen; 
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
        $validated = $request->validate([
            'nama_dosen'           => 'required|string',
            'is_dtps'              => 'required|string',
            'sks_ps_diakreditasi'  => 'required|numeric',
            'sks_ps_lain_dalam_pt' => 'required|numeric',
            'sks_ps_lain_luar_pt'  => 'required|numeric',
            'sks_penelitian'       => 'required|numeric',
            'sks_pkm'              => 'required|numeric',
            'sks_tugas_tambahan'   => 'required|numeric',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // AUTO-KALKULASI SKS SEBELUM DISIMPAN
        $validated['sks_jumlah'] = $validated['sks_ps_diakreditasi'] + $validated['sks_ps_lain_dalam_pt'] + $validated['sks_ps_lain_luar_pt'] + $validated['sks_penelitian'] + $validated['sks_pkm'] + $validated['sks_tugas_tambahan'];
        $validated['sks_rata_rata'] = $validated['sks_jumlah'] / 2;

        BebanKerjaDosen::create($validated);
        
        // Tetap di halaman index
        return redirect()->route('beban_kerja_dosen.index')->with('success', 'Data Beban Kerja Dosen berhasil disimpan!');
    }

    public function edit($id)
    {
        $dosen = BebanKerjaDosen::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        return view('beban_kerja_dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = BebanKerjaDosen::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dosen'           => 'required|string',
            'is_dtps'              => 'required|string',
            'sks_ps_diakreditasi'  => 'required|numeric',
            'sks_ps_lain_dalam_pt' => 'required|numeric',
            'sks_ps_lain_luar_pt'  => 'required|numeric',
            'sks_penelitian'       => 'required|numeric',
            'sks_pkm'              => 'required|numeric',
            'sks_tugas_tambahan'   => 'required|numeric',
        ]);

        // AUTO-KALKULASI ULANG SEBELUM DI-UPDATE
        $validated['sks_jumlah'] = $validated['sks_ps_diakreditasi'] + $validated['sks_ps_lain_dalam_pt'] + $validated['sks_ps_lain_luar_pt'] + $validated['sks_penelitian'] + $validated['sks_pkm'] + $validated['sks_tugas_tambahan'];
        $validated['sks_rata_rata'] = $validated['sks_jumlah'] / 2;

        $dosen->update($validated);
        
        // Tetap di halaman index
        return redirect()->route('beban_kerja_dosen.index')->with('success', 'Data Beban Kerja Dosen berhasil diupdate!');
    }

    public function destroy($id)
    {
        BebanKerjaDosen::where('id', $id)
            ->where('prodi_id', auth()->user()->prodi_id)
            ->firstOrFail()
            ->delete();
            
        return redirect()->route('beban_kerja_dosen.index')->with('success', 'Data Beban Kerja Dosen berhasil dihapus!');
    }
}