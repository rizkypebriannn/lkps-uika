<?php
namespace App\Http\Controllers;

use App\Models\DokumenPembelajaran;
use Illuminate\Http\Request;

class DokumenPembelajaranController extends Controller
{
    public function index()
    {
        // FILTER DATA
        $dokumens = DokumenPembelajaran::where('prodi_id', auth()->user()->prodi_id)->orderBy('mata_kuliah', 'asc')->get();
        return view('dokumen_pembelajaran.index', compact('dokumens'));
    }

    public function store(Request $request)
    {
        // SUNTIKKAN PRODI ID
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id;

        DokumenPembelajaran::create($data);
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
    public function edit($id)
    {
        $dokumen = DokumenPembelajaran::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
        return view('dokumen_pembelajaran.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenPembelajaran::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $dokumen->update($request->all());

        return redirect()->route('dokumen_pembelajaran.index')->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dokumen = DokumenPembelajaran::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $dokumen->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}