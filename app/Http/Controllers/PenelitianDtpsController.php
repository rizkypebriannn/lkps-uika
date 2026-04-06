<?php
namespace App\Http\Controllers;

use App\Models\PenelitianDtps;
use Illuminate\Http\Request;

class PenelitianDtpsController extends Controller
{
    public function index()
    {
        $penelitians = PenelitianDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('penelitian_dtps.index', compact('penelitians'));
    }

    public function store(Request $request)
    {
        // Validasi agar terhindar dari Error 500 (NULL)
        $validated = $request->validate([
            'sumber_pembiayaan' => 'required|string',
            'jumlah_ts2'        => 'required|numeric',
            'jumlah_ts1'        => 'required|numeric',
            'jumlah_ts'         => 'required|numeric',
        ]);

        $validated['prodi_id'] = auth()->user()->prodi_id; 

        PenelitianDtps::create($validated);
        
        return redirect('/dashboard')->with('success', 'Data Penelitian DTPS berhasil disimpan!');
    }

    public function edit($id)
    {
        $penelitian = PenelitianDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('penelitian_dtps.edit', compact('penelitian'));
    }

    public function update(Request $request, $id)
    {
        $penelitian = PenelitianDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $validated = $request->validate([
            'sumber_pembiayaan' => 'required|string',
            'jumlah_ts2'        => 'required|numeric',
            'jumlah_ts1'        => 'required|numeric',
            'jumlah_ts'         => 'required|numeric',
        ]);

        $penelitian->update($validated);

        return redirect()->route('penelitian_dtps.index')->with('success', 'Data Penelitian DTPS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $penelitian = PenelitianDtps::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $penelitian->delete();
        
        return redirect('/dashboard')->with('success', 'Data Penelitian DTPS berhasil dihapus!');
    }
}