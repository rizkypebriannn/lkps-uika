<?php

namespace App\Http\Controllers;

use App\Models\PublikasiIlmiahMahasiswa;
use Illuminate\Http\Request;

class PublikasiIlmiahMahasiswaController extends Controller
{
    public function index()
    {
        $publikasis = PublikasiIlmiahMahasiswa::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('publikasi_ilmiah_mahasiswa.index', compact('publikasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'media_publikasi' => 'required|string',
            'ts_2'            => 'required|numeric|min:0',
            'ts_1'            => 'required|numeric|min:0',
            'ts'              => 'required|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // updateOrCreate otomatis nambah kalau belum ada, dan update kalau sudah ada kategori yang sama
        PublikasiIlmiahMahasiswa::updateOrCreate(
            [
                'prodi_id'        => $validated['prodi_id'],
                'media_publikasi' => $validated['media_publikasi']
            ],
            $validated
        );

        return redirect()->back()->with('success', 'Data Publikasi Ilmiah Mahasiswa berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $publikasi = PublikasiIlmiahMahasiswa::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('publikasi_ilmiah_mahasiswa.edit', compact('publikasi'));
    }

    public function update(Request $request, $id)
    {
        $publikasi = PublikasiIlmiahMahasiswa::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'media_publikasi' => 'required|string',
            'ts_2'            => 'required|numeric|min:0',
            'ts_1'            => 'required|numeric|min:0',
            'ts'              => 'required|numeric|min:0',
        ]);

        $publikasi->update($validated);

        return redirect()->route('publikasi_ilmiah_mahasiswa.index')->with('success', 'Data Publikasi Ilmiah Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $publikasi = PublikasiIlmiahMahasiswa::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $publikasi->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}