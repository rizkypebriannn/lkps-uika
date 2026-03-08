<?php

namespace App\Http\Controllers;

use App\Models\TempatKerjaLulusan;
use Illuminate\Http\Request;

class TempatKerjaLulusanController extends Controller
{
    public function index()
    {
        $data = TempatKerjaLulusan::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun_lulus', 'asc')
                ->get();
                
        return view('tempat_kerja_lulusan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        TempatKerjaLulusan::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.g.1 (Tempat Kerja Lulusan) berhasil disimpan!');
    }

    public function destroy($id)
    {
        TempatKerjaLulusan::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.g.1 berhasil dihapus!');
    }
}