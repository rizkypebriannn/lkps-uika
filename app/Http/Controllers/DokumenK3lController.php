<?php

namespace App\Http\Controllers;

use App\Models\DokumenK3l;
use Illuminate\Http\Request;

class DokumenK3lController extends Controller
{
    public function index()
    {
        $dokumens = DokumenK3l::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('dokumen_k3l.index', compact('dokumens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_dokumen'      => 'required|string',
            'jumlah'             => 'required|numeric|min:1',
            'riwayat_pengesahan' => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        DokumenK3l::create($validated);
        
        return redirect()->back()->with('success', 'Data Dokumen K3L berhasil disimpan!');
    }

    public function edit($id)
    {
        $dokumen = DokumenK3l::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('dokumen_k3l.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenK3l::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'jenis_dokumen'      => 'required|string',
            'jumlah'             => 'required|numeric|min:1',
            'riwayat_pengesahan' => 'required|string',
        ]);

        $dokumen->update($validated);

        return redirect()->route('dokumen_k3l.index')->with('success', 'Data Dokumen K3L berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dokumen = DokumenK3l::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $dokumen->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}