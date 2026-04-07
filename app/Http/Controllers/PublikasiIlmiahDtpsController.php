<?php

namespace App\Http\Controllers;

use App\Models\PublikasiIlmiahDtps;
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
        $validated = $request->validate([
            'jenis_publikasi' => 'required|string',
            'jumlah_ts2'      => 'required|numeric',
            'jumlah_ts1'      => 'required|numeric',
            'jumlah_ts'       => 'required|numeric',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 
        $validated['jumlah_total'] = $validated['jumlah_ts2'] + $validated['jumlah_ts1'] + $validated['jumlah_ts'];

        PublikasiIlmiahDtps::create($validated);
        
        return redirect()->back()->with('success', 'Data Publikasi Ilmiah berhasil disimpan!');
    }

    public function edit($id)
    {
        $publikasi = PublikasiIlmiahDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('publikasi_ilmiah_dtps.edit', compact('publikasi'));
    }

    public function update(Request $request, $id)
    {
        $publikasi = PublikasiIlmiahDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'jenis_publikasi' => 'required|string',
            'jumlah_ts2'      => 'required|numeric',
            'jumlah_ts1'      => 'required|numeric',
            'jumlah_ts'       => 'required|numeric',
        ]);

        $validated['jumlah_total'] = $validated['jumlah_ts2'] + $validated['jumlah_ts1'] + $validated['jumlah_ts'];

        $publikasi->update($validated);

        return redirect()->route('publikasi_ilmiah_dtps.index')->with('success', 'Data Publikasi Ilmiah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $publikasi = PublikasiIlmiahDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
        
        $publikasi->delete();
        return redirect()->back()->with('success', 'Data Publikasi Ilmiah berhasil dihapus!');
    }
}