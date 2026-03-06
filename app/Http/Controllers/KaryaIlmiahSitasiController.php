<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiahSitasi; // <--- PENTING: Anti Class Not Found
use Illuminate\Http\Request;

class KaryaIlmiahSitasiController extends Controller
{
    public function index()
    {
        $sitasis = KaryaIlmiahSitasi::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('karya_ilmiah_sitasi.index', compact('sitasis'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        KaryaIlmiahSitasi::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Sitasi Karya Ilmiah berhasil disimpan!');
    }

    public function destroy($id)
    {
        KaryaIlmiahSitasi::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data Sitasi berhasil dihapus!');
    }
}