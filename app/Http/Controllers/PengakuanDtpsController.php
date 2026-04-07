<?php

namespace App\Http\Controllers;

use App\Models\PengakuanDtps;
use Illuminate\Http\Request;

class PengakuanDtpsController extends Controller
{
    public function index()
    {
        $pengakuans = PengakuanDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('pengakuan_dtps.index', compact('pengakuans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dtps'       => 'required|string',
            'bidang_keahlian' => 'required|string',
            'rekognisi'       => 'required|string',
            'bukti_pendukung' => 'required|string',
            'tingkat'         => 'required|in:Wilayah,Nasional,Internasional',
            'tahun'           => 'required|numeric|min:2000|max:' . date('Y'),
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PengakuanDtps::create($validated);
        
        return redirect()->back()->with('success', 'Data Pengakuan/Rekognisi DTPS berhasil disimpan!');
    }

    public function edit($id)
    {
        $pengakuan = PengakuanDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('pengakuan_dtps.edit', compact('pengakuan'));
    }

    public function update(Request $request, $id)
    {
        $pengakuan = PengakuanDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama_dtps'       => 'required|string',
            'bidang_keahlian' => 'required|string',
            'rekognisi'       => 'required|string',
            'bukti_pendukung' => 'required|string',
            'tingkat'         => 'required|in:Wilayah,Nasional,Internasional',
            'tahun'           => 'required|numeric|min:2000|max:' . date('Y'),
        ]);

        $pengakuan->update($validated);

        return redirect()->route('pengakuan_dtps.index')->with('success', 'Data Pengakuan/Rekognisi DTPS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengakuan = PengakuanDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $pengakuan->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}