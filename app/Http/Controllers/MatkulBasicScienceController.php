<?php
namespace App\Http\Controllers;

use App\Models\MatkulBasicScience;
use Illuminate\Http\Request;

class MatkulBasicScienceController extends Controller
{
    public function index()
    {
        // FILTER: Hanya ambil data yang prodi_id-nya sama dengan prodi_id milik user yang sedang login
        $matkuls = MatkulBasicScience::where('prodi_id', auth()->user()->prodi_id)
                                     ->orderBy('semester', 'asc')
                                     ->get();
                                     
        return view('matkul_basic_science.index', compact('matkuls'));
    }

    public function store(Request $request)
    {
        // AMBIL DATA FORM, LALU SUNTIKKAN KTP PRODI SEBELUM DISIMPAN
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        MatkulBasicScience::create($data);
        return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
    public function destroy($id)
{
    // Cari data berdasarkan ID
    $matkul = MatkulBasicScience::findOrFail($id); 

    // Hapus data
    $matkul->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Mata kuliah Basic Science berhasil dihapus!');
}
}    