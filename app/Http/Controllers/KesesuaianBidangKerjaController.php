<?php

namespace App\Http\Controllers;

use App\Models\KesesuaianBidangKerja;
use Illuminate\Http\Request;

class KesesuaianBidangKerjaController extends Controller
{
    public function index()
    {
        $data = KesesuaianBidangKerja::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun_lulus', 'desc')
                ->get();
                
        return view('kesesuaian_bidang_kerja.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_lulus'             => 'required|string',
            'jumlah_lulusan'          => 'required|numeric|min:0',
            'jumlah_lulusan_terlacak' => 'required|numeric|min:0',
            'kesesuaian_rendah'       => 'required|numeric|min:0',
            'kesesuaian_sedang'       => 'required|numeric|min:0',
            'kesesuaian_tinggi'       => 'required|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        // Kalau tahun lulus yang diinput sudah ada, update datanya. Kalau belum, buat baru.
        KesesuaianBidangKerja::updateOrCreate(
            [
                'prodi_id'    => $validated['prodi_id'],
                'tahun_lulus' => $validated['tahun_lulus']
            ],
            $validated
        );
        
        return redirect()->back()->with('success', 'Data Tabel 6.f.2 (Kesesuaian Bidang Kerja) berhasil disimpan/diperbarui!');
    }

    public function edit($id)
    {
        $data = KesesuaianBidangKerja::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('kesesuaian_bidang_kerja.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = KesesuaianBidangKerja::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'tahun_lulus'             => 'required|string',
            'jumlah_lulusan'          => 'required|numeric|min:0',
            'jumlah_lulusan_terlacak' => 'required|numeric|min:0',
            'kesesuaian_rendah'       => 'required|numeric|min:0',
            'kesesuaian_sedang'       => 'required|numeric|min:0',
            'kesesuaian_tinggi'       => 'required|numeric|min:0',
        ]);

        $data->update($validated);

        return redirect()->route('kesesuaian_bidang_kerja.index')->with('success', 'Data Tabel 6.f.2 berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = KesesuaianBidangKerja::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $data->delete();
        
        return redirect()->back()->with('success', 'Data Tabel 6.f.2 berhasil dihapus!');
    }
}