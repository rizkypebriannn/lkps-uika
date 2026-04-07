<?php

namespace App\Http\Controllers;

use App\Models\PrestasiNonAkademik;
use Illuminate\Http\Request;

class PrestasiNonAkademikController extends Controller
{
    public function index()
    {
        $prestasis = PrestasiNonAkademik::where('prodi_id', auth()->user()->prodi_id)
                        ->orderBy('waktu_perolehan', 'desc')
                        ->get();
        return view('prestasi_non_akademik.index', compact('prestasis'));
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

        PrestasiNonAkademik::create($validated);
        
        return redirect()->back()->with('success', 'Data Prestasi Non-akademik berhasil disimpan!');
    }

    public function edit($id)
    {
        $prestasi = PrestasiNonAkademik::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('prestasi_non_akademik.edit', compact('prestasi'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = PrestasiNonAkademik::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama_kegiatan'    => 'required|string',
            'waktu_perolehan'  => 'required|date',
            'tingkat'          => 'required|in:Lokal/Wilayah,Nasional,Internasional',
            'prestasi_dicapai' => 'required|string',
        ]);

        $prestasi->update($validated);

        return redirect()->route('prestasi_non_akademik.index')->with('success', 'Data Prestasi Non-akademik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prestasi = PrestasiNonAkademik::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $prestasi->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}