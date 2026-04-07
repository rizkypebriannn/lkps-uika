<?php

namespace App\Http\Controllers;

use App\Models\PrestasiAkademik;
use Illuminate\Http\Request;

class PrestasiAkademikController extends Controller
{
    public function index()
    {
        $prestasis = PrestasiAkademik::where('prodi_id', auth()->user()->prodi_id)
                        ->orderBy('waktu_perolehan', 'desc')
                        ->get();
        return view('prestasi_akademik.index', compact('prestasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan'    => 'required|string',
            'waktu_perolehan'  => 'required|date',
            'tingkat'          => 'required|in:Lokal/Wilayah,Nasional,Internasional',
            'prestasi_dicapai' => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PrestasiAkademik::create($validated);
        
        return redirect()->back()->with('success', 'Data Prestasi Akademik berhasil disimpan!');
    }

    public function edit($id)
    {
        $prestasi = PrestasiAkademik::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('prestasi_akademik.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = PrestasiAkademik::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama_kegiatan'    => 'required|string',
            'waktu_perolehan'  => 'required|date',
            'tingkat'          => 'required|in:Lokal/Wilayah,Nasional,Internasional',
            'prestasi_dicapai' => 'required|string',
        ]);

        $prestasi->update($validated);

        return redirect()->route('prestasi_akademik.index')->with('success', 'Data Prestasi Akademik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prestasi = PrestasiAkademik::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $prestasi->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}