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
}    