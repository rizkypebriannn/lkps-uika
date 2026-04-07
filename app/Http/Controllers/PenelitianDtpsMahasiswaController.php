<?php

namespace App\Http\Controllers;

use App\Models\PenelitianDtpsMahasiswa;
use Illuminate\Http\Request;

class PenelitianDtpsMahasiswaController extends Controller
{
    public function index()
    {
        $data = PenelitianDtpsMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun', 'desc')
                ->get();
                
        return view('penelitian_dtps_mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dosen'      => 'required|string',
            'nama_mahasiswa'  => 'required|string',
            'tema_penelitian' => 'required|string',
            'judul_kegiatan'  => 'required|string',
            'tahun'           => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PenelitianDtpsMahasiswa::create($validated);
        
        return redirect()->back()->with('success', 'Data Penelitian DTPS & Mahasiswa berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = PenelitianDtpsMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('penelitian_dtps_mahasiswa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PenelitianDtpsMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dosen'      => 'required|string',
            'nama_mahasiswa'  => 'required|string',
            'tema_penelitian' => 'required|string',
            'judul_kegiatan'  => 'required|string',
            'tahun'           => 'required|string',
        ]);

        $data->update($validated);

        return redirect()->route('penelitian_dtps_mahasiswa.index')->with('success', 'Data Penelitian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PenelitianDtpsMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Penelitian berhasil dihapus!');
    }
}