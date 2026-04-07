<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaPeralatan;
use Illuminate\Http\Request;

class PrasaranaPeralatanController extends Controller
{
    public function index()
    {
        $prasaranas = PrasaranaPeralatan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('prasarana_peralatan.index', compact('prasaranas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_prasarana'   => 'required|string',
            'jumlah_prasarana' => 'required|numeric|min:1',
            'nama_sarana'      => 'required|string',
            'standar_minimal'  => 'required|numeric|min:0',
            'dimiliki_upps'    => 'required|numeric|min:0',
            'kepemilikan'      => 'required|in:Sendiri,Sewa',
            'kondisi'          => 'required|in:Terawat,Tidak Terawat',
            'logbook'          => 'nullable|string',
            'waktu_penggunaan' => 'nullable|string',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PrasaranaPeralatan::create($validated);
        
        return redirect()->back()->with('success', 'Data Prasarana & Peralatan berhasil disimpan!');
    }

    public function edit($id)
    {
        $prasarana = PrasaranaPeralatan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('prasarana_peralatan.edit', compact('prasarana'));
    }

    public function update(Request $request, $id)
    {
        $prasarana = PrasaranaPeralatan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'nama_prasarana'   => 'required|string',
            'jumlah_prasarana' => 'required|numeric|min:1',
            'nama_sarana'      => 'required|string',
            'standar_minimal'  => 'required|numeric|min:0',
            'dimiliki_upps'    => 'required|numeric|min:0',
            'kepemilikan'      => 'required|in:Sendiri,Sewa',
            'kondisi'          => 'required|in:Terawat,Tidak Terawat',
            'logbook'          => 'nullable|string',
            'waktu_penggunaan' => 'nullable|string',
        ]);

        $prasarana->update($validated);

        return redirect()->route('prasarana_peralatan.index')->with('success', 'Data Prasarana & Peralatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $prasarana = PrasaranaPeralatan::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $prasarana->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}