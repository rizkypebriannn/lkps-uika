<?php

namespace App\Http\Controllers;

use App\Models\KepuasanPenggunaLulusan;
use Illuminate\Http\Request;

class KepuasanPenggunaLulusanController extends Controller
{
    public function index()
    {
        $data = KepuasanPenggunaLulusan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kepuasan_pengguna_lulusan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kemampuan'       => 'required|string',
            'sangat_baik'           => 'required|numeric|min:0',
            'baik'                  => 'required|numeric|min:0',
            'cukup'                 => 'required|numeric|min:0',
            'kurang'                => 'required|numeric|min:0',
            'rencana_tindak_lanjut' => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Kalau Jenis Kemampuan yang diinput sudah ada, update datanya. Kalau belum, buat baru.
        KepuasanPenggunaLulusan::updateOrCreate(
            [
                'prodi_id'        => $validated['prodi_id'],
                'jenis_kemampuan' => $validated['jenis_kemampuan']
            ],
            $validated
        );
        
        return redirect()->back()->with('success', 'Data Tabel 6.g.2 (Kepuasan Pengguna) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $data = KepuasanPenggunaLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('kepuasan_pengguna_lulusan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = KepuasanPenggunaLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'jenis_kemampuan'       => 'required|string',
            'sangat_baik'           => 'required|numeric|min:0',
            'baik'                  => 'required|numeric|min:0',
            'cukup'                 => 'required|numeric|min:0',
            'kurang'                => 'required|numeric|min:0',
            'rencana_tindak_lanjut' => 'required|string',
        ]);

        $data->update($validated);

        return redirect()->route('kepuasan_pengguna_lulusan.index')->with('success', 'Data Tabel 6.g.2 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = KepuasanPenggunaLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 6.g.2 berhasil dihapus!');
    }
}