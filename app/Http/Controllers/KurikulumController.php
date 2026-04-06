<?php
namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        // Hanya ambil data milik Prodi yang login
        $kurikulums = Kurikulum::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('kurikulum.index', compact('kurikulums'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; // Suntikkan KTP Prodi
        Kurikulum::create($data);
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $kurikulum = Kurikulum::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
        return view('kurikulum.edit', compact('kurikulum'));
    }

    public function update(Request $request, $id)
    {
        $kurikulum = Kurikulum::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $data = $request->all();
        
        // Logika Checkbox: Jika tidak dicentang, set value jadi 0
        $data['is_mk_kompetensi'] = $request->has('is_mk_kompetensi') ? 1 : 0;

        $kurikulum->update($data);

        return redirect()->route('kurikulum.index')->with('success', 'Mata kuliah berhasil diperbarui!');
    }
    public function destroy($id)
    {
        // Mencari data berdasarkan ID, jika tidak ada akan error 404
        $kurikulum = Kurikulum::findOrFail($id); 
        
        // Menghapus data dari database
        $kurikulum->delete();

        // Mengembalikan halaman dengan pesan sukses
        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus!');
    }
}