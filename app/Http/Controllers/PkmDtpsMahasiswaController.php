<?php

namespace App\Http\Controllers;

use App\Models\PkmDtpsMahasiswa;
use Illuminate\Http\Request;

class PkmDtpsMahasiswaController extends Controller
{
    public function index()
    {
        $data = PkmDtpsMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun', 'desc')
                ->get();
                
        return view('pkm_dtps_mahasiswa.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dosen'       => 'required|string',
            'nama_mahasiswa'   => 'required|array',
            'nama_mahasiswa.*' => 'required|string',
            'tema_pkm'         => 'required|string',
            'judul_kegiatan'   => 'required|string',
            'tahun'            => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // TRICK SAKTI: Gabungkan array mahasiswa menjadi string dipisah koma
        $validated['nama_mahasiswa'] = implode(', ', $validated['nama_mahasiswa']);

        PkmDtpsMahasiswa::create($validated);
        
        return redirect()->back()->with('success', 'Data Tabel 6.i (PkM DTPS & Mahasiswa) berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = PkmDtpsMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('pkm_dtps_mahasiswa.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = PkmDtpsMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dosen'       => 'required|string',
            'nama_mahasiswa'   => 'required|array',
            'nama_mahasiswa.*' => 'required|string',
            'tema_pkm'         => 'required|string',
            'judul_kegiatan'   => 'required|string',
            'tahun'            => 'required|string',
        ]);

        // TRICK SAKTI: Gabungkan array mahasiswa menjadi string dipisah koma
        $validated['nama_mahasiswa'] = implode(', ', $validated['nama_mahasiswa']);

        $data->update($validated);

        return redirect()->route('pkm_dtps_mahasiswa.index')->with('success', 'Data Tabel 6.i berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = PkmDtpsMahasiswa::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 6.i berhasil dihapus!');
    }
}