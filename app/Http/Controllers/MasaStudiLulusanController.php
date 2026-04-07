<?php

namespace App\Http\Controllers;

use App\Models\MasaStudiLulusan;
use Illuminate\Http\Request;

class MasaStudiLulusanController extends Controller
{
    public function index()
    {
        // Mengurutkan dari TS-7 sampai TS
        $masa_studi = MasaStudiLulusan::where('prodi_id', auth()->user()->prodi_id)
                        ->orderByRaw("FIELD(tahun_masuk, 'TS-7', 'TS-6', 'TS-5', 'TS-4', 'TS-3', 'TS-2', 'TS-1', 'TS')")
                        ->get();
        return view('masa_studi_lulusan.index', compact('masa_studi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_masuk'  => 'required|in:TS-7,TS-6,TS-5,TS-4,TS-3,TS-2,TS-1,TS',
            'jumlah_masuk' => 'required|numeric|min:0',
            'lulus_3_5'    => 'nullable|numeric|min:0',
            'lulus_4_5'    => 'nullable|numeric|min:0',
            'lulus_5_5'    => 'nullable|numeric|min:0',
            'lulus_6_5'    => 'nullable|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id;

        // updateOrCreate: Kalau tahun_masuk sudah ada, di-update. Kalau belum, di-create.
        MasaStudiLulusan::updateOrCreate(
            [
                'prodi_id'    => $validated['prodi_id'],
                'tahun_masuk' => $validated['tahun_masuk']
            ],
            $validated
        );

        return redirect()->back()->with('success', 'Data Masa Studi ' . $request->tahun_masuk . ' berhasil disimpan!');
    }

    public function edit($id)
    {
        $masa_studi = MasaStudiLulusan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('masa_studi_lulusan.edit', compact('masa_studi'));
    }

    public function update(Request $request, $id)
    {
        $masa_studi = MasaStudiLulusan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'tahun_masuk'  => 'required|in:TS-7,TS-6,TS-5,TS-4,TS-3,TS-2,TS-1,TS',
            'jumlah_masuk' => 'required|numeric|min:0',
            'lulus_3_5'    => 'nullable|numeric|min:0',
            'lulus_4_5'    => 'nullable|numeric|min:0',
            'lulus_5_5'    => 'nullable|numeric|min:0',
            'lulus_6_5'    => 'nullable|numeric|min:0',
        ]);

        $masa_studi->update($validated);

        return redirect()->route('masa_studi_lulusan.index')->with('success', 'Data Masa Studi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $masa_studi = MasaStudiLulusan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $masa_studi->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}