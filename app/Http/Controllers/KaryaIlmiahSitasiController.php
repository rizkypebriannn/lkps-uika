<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiahSitasi;
use Illuminate\Http\Request;

class KaryaIlmiahSitasiController extends Controller
{
    public function index()
    {
        $sitasis = KaryaIlmiahSitasi::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('karya_ilmiah_sitasi.index', compact('sitasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dtps'     => 'required|string',
            'jumlah_sitasi' => 'required|numeric|min:0',
            'judul_artikel' => 'required|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        KaryaIlmiahSitasi::create($validated);
        
        return redirect()->back()->with('success', 'Data Sitasi Karya Ilmiah berhasil disimpan!');
    }

    public function edit($id)
    {
        $sitasi = KaryaIlmiahSitasi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        return view('karya_ilmiah_sitasi.edit', compact('sitasi'));
    }

    public function update(Request $request, $id)
    {
        $sitasi = KaryaIlmiahSitasi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'nama_dtps'     => 'required|string',
            'jumlah_sitasi' => 'required|numeric|min:0',
            'judul_artikel' => 'required|string',
        ]);

        $sitasi->update($validated);

        return redirect()->route('karya_ilmiah_sitasi.index')->with('success', 'Data Sitasi Karya Ilmiah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sitasi = KaryaIlmiahSitasi::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                    
        $sitasi->delete();
        
        return redirect()->back()->with('success', 'Data Sitasi berhasil dihapus!');
    }
}