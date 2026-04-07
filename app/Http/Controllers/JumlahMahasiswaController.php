<?php

namespace App\Http\Controllers;

use App\Models\JumlahMahasiswa; // <--- INI DIA KUNCINYA
use Illuminate\Http\Request;

class JumlahMahasiswaController extends Controller
{
    public function index()
    {
        // Panggil dari model JumlahMahasiswa
        $mahasiswas = JumlahMahasiswa::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('jumlah_mahasiswa.index', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_studi' => 'required|string',
            'aktif_ts2'     => 'required|numeric',
            'aktif_ts1'     => 'required|numeric',
            'aktif_ts'      => 'required|numeric',
            'asing_ft_ts2'  => 'nullable|numeric',
            'asing_ft_ts1'  => 'nullable|numeric',
            'asing_ft_ts'   => 'nullable|numeric',
            'asing_pt_ts2'  => 'nullable|numeric',
            'asing_pt_ts1'  => 'nullable|numeric',
            'asing_pt_ts'   => 'nullable|numeric',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id;

        // Simpan menggunakan model JumlahMahasiswa
        JumlahMahasiswa::create($validated);
        
        return redirect()->back()->with('success', 'Data Mahasiswa berhasil disimpan!');
    }

    public function edit($id)
    {
        $mahasiswa = JumlahMahasiswa::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('jumlah_mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = JumlahMahasiswa::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'program_studi' => 'required|string',
            'aktif_ts2'     => 'required|numeric',
            'aktif_ts1'     => 'required|numeric',
            'aktif_ts'      => 'required|numeric',
            'asing_ft_ts2'  => 'nullable|numeric',
            'asing_ft_ts1'  => 'nullable|numeric',
            'asing_ft_ts'   => 'nullable|numeric',
            'asing_pt_ts2'  => 'nullable|numeric',
            'asing_pt_ts1'  => 'nullable|numeric',
            'asing_pt_ts'   => 'nullable|numeric',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('jumlah_mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mahasiswa = JumlahMahasiswa::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $mahasiswa->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}