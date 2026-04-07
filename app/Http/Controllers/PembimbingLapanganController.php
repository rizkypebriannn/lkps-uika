<?php

namespace App\Http\Controllers;

use App\Models\PembimbingLapangan;
use Illuminate\Http\Request;

class PembimbingLapanganController extends Controller
{
    public function index()
    {
        $pembimbings = PembimbingLapangan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('pembimbing_lapangan.index', compact('pembimbings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'                 => 'required|string',
            'industri'             => 'required|string',
            'bidang_keinsinyuran'  => 'required|string',
            'pengalaman_kerja'     => 'required|numeric|min:0',
            'pendidikan_tinggi'    => 'required|string',
            'kategori_sip'         => 'required|in:IPM,IPU',
            'nomor_sip'            => 'required|string',
            'tanggal_berakhir_sip' => 'required|date',
            'jumlah_bimbingan'     => 'required|numeric|min:0',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PembimbingLapangan::create($validated);
        
        return redirect()->back()->with('success', 'Data Pembimbing Lapangan berhasil disimpan!');
    }

    public function edit($id)
    {
        $pembimbing = PembimbingLapangan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('pembimbing_lapangan.edit', compact('pembimbing'));
    }

    public function update(Request $request, $id)
    {
        $pembimbing = PembimbingLapangan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama'                 => 'required|string',
            'industri'             => 'required|string',
            'bidang_keinsinyuran'  => 'required|string',
            'pengalaman_kerja'     => 'required|numeric|min:0',
            'pendidikan_tinggi'    => 'required|string',
            'kategori_sip'         => 'required|in:IPM,IPU',
            'nomor_sip'            => 'required|string',
            'tanggal_berakhir_sip' => 'required|date',
            'jumlah_bimbingan'     => 'required|numeric|min:0',
        ]);

        $pembimbing->update($validated);

        return redirect()->route('pembimbing_lapangan.index')->with('success', 'Data Pembimbing Lapangan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pembimbing = PembimbingLapangan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $pembimbing->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}