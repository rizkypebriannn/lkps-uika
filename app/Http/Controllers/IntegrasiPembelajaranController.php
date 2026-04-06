<?php
namespace App\Http\Controllers;

use App\Models\IntegrasiPembelajaran;
use Illuminate\Http\Request;

class IntegrasiPembelajaranController extends Controller
{
   public function index()
    {
        // FILTER DATA
        $integrasis = IntegrasiPembelajaran::where('prodi_id', auth()->user()->prodi_id)->orderBy('created_at', 'desc')->get();
        return view('integrasi_pembelajaran.index', compact('integrasis'));
    }

    public function store(Request $request)
    {
        // SUNTIKKAN PRODI ID
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id;

        IntegrasiPembelajaran::create($data);
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
    public function edit($id)
    {
        $integrasi = IntegrasiPembelajaran::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('integrasi_pembelajaran.edit', compact('integrasi'));
    }

    public function update(Request $request, $id)
    {
        $integrasi = IntegrasiPembelajaran::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $integrasi->update($request->all());

        return redirect()->route('integrasi_pembelajaran.index')->with('success', 'Data Integrasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Gembok keamanan tambahan agar tidak bisa menghapus data prodi lain
        $integrasi = IntegrasiPembelajaran::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $integrasi->delete();
        return redirect()->back()->with('success', 'Data Integrasi berhasil dihapus!');
    }
    
}