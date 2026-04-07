<?php

namespace App\Http\Controllers;

use App\Models\KinerjaDtps; 
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
        $validated = $request->validate([
            'nama_dtps'  => 'required|string',
            'jumlah_ts2' => 'required|numeric',
            'jumlah_ts1' => 'required|numeric',
            'jumlah_ts'  => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 
        
        // Auto-kalkulasi Jumlah Publikasi
        $validated['jumlah_publikasi'] = $validated['jumlah_ts2'] + $validated['jumlah_ts1'] + $validated['jumlah_ts'];

        KinerjaDtps::create($validated);
        
        return redirect()->back()->with('success', 'Data Kinerja DTPS berhasil disimpan!');
    }

    public function edit($id)
    {
        $kinerja = KinerjaDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('kinerja_dtps.edit', compact('kinerja'));
    }

    public function update(Request $request, $id)
    {
        $kinerja = KinerjaDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dtps'  => 'required|string',
            'jumlah_ts2' => 'required|numeric',
            'jumlah_ts1' => 'required|numeric',
            'jumlah_ts'  => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        // Auto-kalkulasi ulang saat di-update
        $validated['jumlah_publikasi'] = $validated['jumlah_ts2'] + $validated['jumlah_ts1'] + $validated['jumlah_ts'];

        $kinerja->update($validated);

        return redirect()->route('kinerja_dtps.index')->with('success', 'Data Kinerja DTPS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kinerja = KinerjaDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $kinerja->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}