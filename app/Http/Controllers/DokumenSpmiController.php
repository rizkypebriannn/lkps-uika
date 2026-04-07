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
        $validated = $request->validate([
            'jenis_dokumen'   => 'required|string',
            'nomor_dokumen'   => 'required|string',
            'tanggal_dokumen' => 'required|date',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Auto Update jika jenis dokumen sudah pernah diinput
        DokumenSpmi::updateOrCreate(
            [
                'prodi_id'      => $validated['prodi_id'],
                'jenis_dokumen' => $validated['jenis_dokumen']
            ],
            $validated
        );
        
        return redirect()->back()->with('success', 'Data Tabel 7.a (Dokumen SPMI) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $data = DokumenSpmi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('dokumen_spmi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = DokumenSpmi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'jenis_dokumen'   => 'required|string',
            'nomor_dokumen'   => 'required|string',
            'tanggal_dokumen' => 'required|date',
        ]);

        $data->update($validated);

        return redirect()->route('dokumen_spmi.index')->with('success', 'Data Tabel 7.a berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = DokumenSpmi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 7.a berhasil dihapus!');
    }
}