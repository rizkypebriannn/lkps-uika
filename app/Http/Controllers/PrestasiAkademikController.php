<?php

namespace App\Http\Controllers;

use App\Models\PrestasiAkademik;
use Illuminate\Http\Request;

class PrestasiAkademikController extends Controller
{
    public function index()
    {
        $prestasis = PrestasiAkademik::where('prodi_id', auth()->user()->prodi_id)
                        ->orderBy('waktu_perolehan', 'desc')
                        ->get();
        return view('prestasi_akademik.index', compact('prestasis'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PrestasiAkademik::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Prestasi Akademik berhasil disimpan!');
    }

    public function destroy($id)
    {
        PrestasiAkademik::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}