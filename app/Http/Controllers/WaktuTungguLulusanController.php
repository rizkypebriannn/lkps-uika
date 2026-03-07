<?php

namespace App\Http\Controllers;

use App\Models\WaktuTungguLulusan;
use Illuminate\Http\Request;

class WaktuTungguLulusanController extends Controller
{
    public function index()
    {
        // Mengurutkan berdasarkan tahun lulus
        $data = WaktuTungguLulusan::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun_lulus', 'desc')
                ->get();
                
        return view('waktu_tunggu_lulusan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        WaktuTungguLulusan::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.f.1 (Waktu Tunggu Lulusan) berhasil disimpan!');
    }

    public function destroy($id)
    {
        WaktuTungguLulusan::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.f.1 berhasil dihapus!');
    }
}