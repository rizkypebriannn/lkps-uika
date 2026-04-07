<?php

namespace App\Http\Controllers;

use App\Models\PenelitianDtpsRujukan;
use Illuminate\Http\Request;

class PenelitianDtpsRujukanController extends Controller
{
    public function index()
    {
        $data = PenelitianDtpsRujukan::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun', 'desc')
                ->get();
                
        return view('penelitian_dtps_rujukan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dosen'      => 'required|string',
            'nama_mahasiswa'  => 'required|string',
            'tema_penelitian' => 'required|string',
            'judul_tesis'     => 'required|string',
            'tahun'           => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PenelitianDtpsRujukan::create($validated);
        
        return redirect()->back()->with('success', 'Data Tabel 6.h.2 (Penelitian Rujukan Tesis) berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = PenelitianDtpsRujukan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('penelitian_dtps_rujukan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PenelitianDtpsRujukan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dosen'      => 'required|string',
            'nama_mahasiswa'  => 'required|string',
            'tema_penelitian' => 'required|string',
            'judul_tesis'     => 'required|string',
            'tahun'           => 'required|string',
        ]);

        $data->update($validated);

        return redirect()->route('penelitian_dtps_rujukan.index')->with('success', 'Data Tabel 6.h.2 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PenelitianDtpsRujukan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 6.h.2 berhasil dihapus!');
    }
}