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

    public function edit($id)
    {
        $matkul = MatkulBasicScience::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('matkul_basic_science.edit', compact('matkul'));
    }

    public function update(Request $request, $id)
    {
        $matkul = MatkulBasicScience::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $matkul->update($request->all());

        return redirect()->route('matkul_basic_science.index')->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Gembok keamanan ditambahkan di sini
        $matkul = MatkulBasicScience::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail(); 

        $matkul->delete();

        return redirect()->back()->with('success', 'Mata kuliah Basic Science berhasil dihapus!');
    }
   
}    