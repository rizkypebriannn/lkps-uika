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
        $validated = $request->validate([
            'dokumen'                  => 'required|string',
            'link_dokumen'             => 'required|url',
            'link_laporan_audit'       => 'nullable|url',
            'link_laporan_rtm'         => 'nullable|url',
            'link_dokumen_peningkatan' => 'nullable|url',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Auto Update jika tahapan dokumen sudah pernah diinput
        PelaksanaanSpmi::updateOrCreate(
            [
                'prodi_id' => $validated['prodi_id'],
                'dokumen'  => $validated['dokumen']
            ],
            $validated
        );
        
        return redirect()->back()->with('success', 'Data Tabel 7.b (Pelaksanaan SPMI) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $data = PelaksanaanSpmi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('pelaksanaan_spmi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PelaksanaanSpmi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'dokumen'                  => 'required|string',
            'link_dokumen'             => 'required|url',
            'link_laporan_audit'       => 'nullable|url',
            'link_laporan_rtm'         => 'nullable|url',
            'link_dokumen_peningkatan' => 'nullable|url',
        ]);

        $data->update($validated);

        return redirect()->route('pelaksanaan_spmi.index')->with('success', 'Data Tabel 7.b berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PelaksanaanSpmi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 7.b berhasil dihapus!');
    }
}