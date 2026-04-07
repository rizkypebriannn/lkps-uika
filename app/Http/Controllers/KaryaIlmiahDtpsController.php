<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiahDtps;
use Illuminate\Http\Request;

class KaryaIlmiahDtpsController extends Controller
{
    public function index()
    {
        $karyas = KaryaIlmiahDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('karya_ilmiah_dtps.index', compact('karyas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_publikasi' => 'required|string',
            'jumlah_ts2'      => 'required|numeric',
            'jumlah_ts1'      => 'required|numeric',
            'jumlah_ts'       => 'required|numeric',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 
        
        // Auto-kalkulasi total
        $validated['jumlah_total'] = $validated['jumlah_ts2'] + $validated['jumlah_ts1'] + $validated['jumlah_ts'];

        KaryaIlmiahDtps::create($validated);
        
        // Tetap di halaman index
        return redirect()->back()->with('success', 'Data Karya Ilmiah & Pameran berhasil disimpan!');
    }

    public function edit($id)
    {
        $karya = KaryaIlmiahDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('karya_ilmiah_dtps.edit', compact('karya'));
    }

    public function update(Request $request, $id)
    {
        $karya = KaryaIlmiahDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'jenis_publikasi' => 'required|string',
            'jumlah_ts2'      => 'required|numeric',
            'jumlah_ts1'      => 'required|numeric',
            'jumlah_ts'       => 'required|numeric',
        ]);

        // Auto-kalkulasi ulang saat update
        $validated['jumlah_total'] = $validated['jumlah_ts2'] + $validated['jumlah_ts1'] + $validated['jumlah_ts'];

        $karya->update($validated);

        return redirect()->route('karya_ilmiah_dtps.index')->with('success', 'Data Karya Ilmiah & Pameran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $karya = KaryaIlmiahDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $karya->delete();
        
        return redirect()->back()->with('success', 'Data Karya Ilmiah berhasil dihapus!');
    }
}