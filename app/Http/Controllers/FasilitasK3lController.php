<?php

namespace App\Http\Controllers;

use App\Models\FasilitasK3l;
use Illuminate\Http\Request;

class FasilitasK3lController extends Controller
{
    public function index()
    {
        $fasilitas = FasilitasK3l::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('fasilitas_k3l.index', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sarana' => 'required|string',
            'fungsi'      => 'required|string',
            'jumlah_unit' => 'required|numeric|min:1',
            'kondisi'     => 'required|in:Terawat,Tidak Terawat',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        FasilitasK3l::create($validated);
        
        return redirect()->back()->with('success', 'Data Fasilitas K3L berhasil disimpan!');
    }

    public function edit($id)
    {
        $fasilitas = FasilitasK3l::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('fasilitas_k3l.edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = FasilitasK3l::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama_sarana' => 'required|string',
            'fungsi'      => 'required|string',
            'jumlah_unit' => 'required|numeric|min:1',
            'kondisi'     => 'required|in:Terawat,Tidak Terawat',
        ]);

        $fasilitas->update($validated);

        return redirect()->route('fasilitas_k3l.index')->with('success', 'Data Fasilitas K3L berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $fasilitas = FasilitasK3l::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $fasilitas->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}