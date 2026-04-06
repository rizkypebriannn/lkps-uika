<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenagaKependidikan;

class TenagaKependidikanController extends Controller
{
    public function index()
    {
        $tenagas = TenagaKependidikan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('tenaga_kependidikan.index', compact('tenagas'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_tenaga_kependidikan' => 'required|string',
            'pendidikan_terakhir'      => 'required|string',
            'sertifikat_kompetensi'    => 'nullable|string',
            'unit_kerja'               => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        TenagaKependidikan::create($validated);
        
        // Tetap di halaman index setelah simpan
        return redirect()->route('tenaga_kependidikan.index')->with('success', 'Data Tenaga Kependidikan berhasil disimpan!');
    }

    public function edit($id)
    {
        $tenaga = TenagaKependidikan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('tenaga_kependidikan.edit', compact('tenaga'));
    }

    public function update(Request $request, $id)
    {
        $tenaga = TenagaKependidikan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_tenaga_kependidikan' => 'required|string',
            'pendidikan_terakhir'      => 'required|string',
            'sertifikat_kompetensi'    => 'nullable|string',
            'unit_kerja'               => 'required|string',
        ]);

        $tenaga->update($validated);

        // Tetap di halaman index setelah update
        return redirect()->route('tenaga_kependidikan.index')->with('success', 'Data Tenaga Kependidikan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Tambahkan gembok prodi_id sebelum menghapus
        $tenaga = TenagaKependidikan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $tenaga->delete();
        
        // Tetap di halaman index setelah hapus
        return redirect()->route('tenaga_kependidikan.index')->with('success', 'Data berhasil dihapus!');
    }
}