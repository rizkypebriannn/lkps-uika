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
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        // Cek jika kategori publikasi ini sudah pernah diinput
        $existing = PublikasiIlmiahMahasiswa::where('prodi_id', auth()->user()->prodi_id)
                                            ->where('media_publikasi', $request->media_publikasi)
                                            ->first();

        if ($existing) {
            $existing->update($data);
            return redirect('/dashboard')->with('success', 'Data Publikasi untuk kategori tersebut berhasil diperbarui!');
        }

        PublikasiIlmiahMahasiswa::create($data);
        return redirect('/dashboard')->with('success', 'Data Publikasi Ilmiah Mahasiswa berhasil disimpan!');
    }

    public function destroy($id)
    {
        PublikasiIlmiahMahasiswa::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}