<?php
namespace App\Http\Controllers;

use App\Models\PkmDtps;
use Illuminate\Http\Request;

class PkmDtpsController extends Controller
{
    public function index()
    {
        $pkms = PkmDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('pkm_dtps.index', compact('pkms'));
    }

    public function store(Request $request)
    {
        // Validasi input untuk mencegah error 'cannot be null'
        $validated = $request->validate([
            'sumber_pembiayaan' => 'required|string',
            'jumlah_ts2'        => 'required|numeric',
            'jumlah_ts1'        => 'required|numeric',
            'jumlah_ts'         => 'required|numeric',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PkmDtps::create($validated);
        
        return redirect('/dashboard')->with('success', 'Data PkM DTPS berhasil disimpan!');
    }

    public function edit($id)
    {
        $pkm = PkmDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();
                        
        return view('pkm_dtps.edit', compact('pkm'));
    }

    public function update(Request $request, $id)
    {
        $pkm = PkmDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $validated = $request->validate([
            'sumber_pembiayaan' => 'required|string',
            'jumlah_ts2'        => 'required|numeric',
            'jumlah_ts1'        => 'required|numeric',
            'jumlah_ts'         => 'required|numeric',
        ]);

        $pkm->update($validated);

        return redirect()->route('pkm_dtps.index')->with('success', 'Data PkM DTPS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Gembok keamanan agar prodi lain tidak bisa iseng menghapus
        $pkm = PkmDtps::where('id', $id)
                    ->where('prodi_id', auth()->user()->prodi_id)
                    ->firstOrFail();

        $pkm->delete();
        
        return redirect('/dashboard')->with('success', 'Data PkM DTPS berhasil dihapus!');
    }
}