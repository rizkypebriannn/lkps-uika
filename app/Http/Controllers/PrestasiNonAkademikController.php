<?php

namespace App\Http\Controllers;

use App\Models\PrestasiNonAkademik;
use Illuminate\Http\Request;

class PrestasiNonAkademikController extends Controller
{
    public function index()
    {
        $prestasis = PrestasiNonAkademik::where('prodi_id', auth()->user()->prodi_id)
                        ->orderBy('waktu_perolehan', 'desc')
                        ->get();
        return view('prestasi_non_akademik.index', compact('prestasis'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PrestasiNonAkademik::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Prestasi Non-akademik berhasil disimpan!');
    }

    public function destroy($id)
    {
        PrestasiNonAkademik::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}