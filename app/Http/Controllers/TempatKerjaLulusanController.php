<?php

namespace App\Http\Controllers;

use App\Models\TempatKerjaLulusan;
use Illuminate\Http\Request;

class TempatKerjaLulusanController extends Controller
{
    public function index()
    {
        $data = TempatKerjaLulusan::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun_lulus', 'desc')
                ->get();
                
        return view('tempat_kerja_lulusan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_lulus'           => 'required|string',
            'jumlah_lulusan'        => 'required|numeric|min:0',
            'jumlah_tanggapan'      => 'required|numeric|min:0',
            'jumlah_terlacak'       => 'required|numeric|min:0',
            'tingkat_lokal'         => 'required|numeric|min:0',
            'tingkat_nasional'      => 'required|numeric|min:0',
            'tingkat_multinasional' => 'required|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Auto Update kalau tahun lulus sudah ada
        TempatKerjaLulusan::updateOrCreate(
            [
                'prodi_id'    => $validated['prodi_id'],
                'tahun_lulus' => $validated['tahun_lulus']
            ],
            $validated
        );
        
        return redirect()->back()->with('success', 'Data Tabel 6.g.1 (Tempat Kerja Lulusan) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $data = TempatKerjaLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('tempat_kerja_lulusan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = TempatKerjaLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'tahun_lulus'           => 'required|string',
            'jumlah_lulusan'        => 'required|numeric|min:0',
            'jumlah_tanggapan'      => 'required|numeric|min:0',
            'jumlah_terlacak'       => 'required|numeric|min:0',
            'tingkat_lokal'         => 'required|numeric|min:0',
            'tingkat_nasional'      => 'required|numeric|min:0',
            'tingkat_multinasional' => 'required|numeric|min:0',
        ]);

        $data->update($validated);

        return redirect()->route('tempat_kerja_lulusan.index')->with('success', 'Data Tabel 6.g.1 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = TempatKerjaLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 6.g.1 berhasil dihapus!');
    }
}