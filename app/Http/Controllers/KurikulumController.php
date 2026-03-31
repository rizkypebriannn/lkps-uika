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