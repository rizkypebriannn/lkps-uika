<?php

namespace App\Http\Controllers;

use App\Models\WaktuTungguLulusan;
use Illuminate\Http\Request;

class WaktuTungguLulusanController extends Controller
{
    public function index()
    {
        $data = WaktuTungguLulusan::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun_lulus', 'desc')
                ->get();
                
        return view('waktu_tunggu_lulusan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_lulus'             => 'required|string',
            'jumlah_lulusan'          => 'required|numeric|min:0',
            'jumlah_lulusan_terlacak' => 'required|numeric|min:0',
            'wt_kurang_3_bulan'       => 'required|numeric|min:0',
            'wt_antara_3_18_bulan'    => 'required|numeric|min:0',
            'wt_lebih_18_bulan'       => 'required|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Kalau tahun lulus yang diinput sudah ada, update datanya. Kalau belum, buat baru.
        WaktuTungguLulusan::updateOrCreate(
            [
                'prodi_id'    => $validated['prodi_id'],
                'tahun_lulus' => $validated['tahun_lulus']
            ],
            $validated
        );
        
        return redirect()->back()->with('success', 'Data Tabel 6.f.1 (Waktu Tunggu Lulusan) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $data = WaktuTungguLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('waktu_tunggu_lulusan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = WaktuTungguLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'tahun_lulus'             => 'required|string',
            'jumlah_lulusan'          => 'required|numeric|min:0',
            'jumlah_lulusan_terlacak' => 'required|numeric|min:0',
            'wt_kurang_3_bulan'       => 'required|numeric|min:0',
            'wt_antara_3_18_bulan'    => 'required|numeric|min:0',
            'wt_lebih_18_bulan'       => 'required|numeric|min:0',
        ]);

        $data->update($validated);

        return redirect()->route('waktu_tunggu_lulusan.index')->with('success', 'Data Tabel 6.f.1 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = WaktuTungguLulusan::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}