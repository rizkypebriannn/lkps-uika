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
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        // Cek jika kategori ini sudah pernah diinput (Auto Update)
        $existing = PublikasiMahasiswaTerapan::where('prodi_id', auth()->user()->prodi_id)
                                             ->where('jenis_publikasi', $request->jenis_publikasi)
                                             ->first();

        if ($existing) {
            $existing->update($data);
            return redirect('/dashboard')->with('success', 'Data Publikasi (Terapan) berhasil diperbarui!');
        }

        PublikasiMahasiswaTerapan::create($data);
        return redirect('/dashboard')->with('success', 'Data Publikasi (Terapan) berhasil disimpan!');
    }

    public function destroy($id)
    {
        PublikasiMahasiswaTerapan::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}