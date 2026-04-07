<?php

namespace App\Http\Controllers;

use App\Models\PublikasiMahasiswaTerapan;
use Illuminate\Http\Request;

class PublikasiMahasiswaTerapanController extends Controller
{
    public function index()
    {
        $publikasis = PublikasiMahasiswaTerapan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('publikasi_mahasiswa_terapan.index', compact('publikasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_publikasi' => 'required|string',
            'ts_2'            => 'required|numeric|min:0',
            'ts_1'            => 'required|numeric|min:0',
            'ts'              => 'required|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Auto insert kalau baru, auto update kalau jenisnya sudah ada
        PublikasiMahasiswaTerapan::updateOrCreate(
            [
                'prodi_id'        => $validated['prodi_id'],
                'jenis_publikasi' => $validated['jenis_publikasi']
            ],
            $validated
        );

        return redirect()->back()->with('success', 'Data Publikasi (Terapan) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $publikasi = PublikasiMahasiswaTerapan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('publikasi_mahasiswa_terapan.edit', compact('publikasi'));
    }

    public function update(Request $request, $id)
    {
        $publikasi = PublikasiMahasiswaTerapan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'jenis_publikasi' => 'required|string',
            'ts_2'            => 'required|numeric|min:0',
            'ts_1'            => 'required|numeric|min:0',
            'ts'              => 'required|numeric|min:0',
        ]);

        $publikasi->update($validated);

        return redirect()->route('publikasi_mahasiswa_terapan.index')->with('success', 'Data Publikasi (Terapan) berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $publikasi = PublikasiMahasiswaTerapan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $publikasi->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}