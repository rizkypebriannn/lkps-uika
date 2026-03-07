<?php

namespace App\Http\Controllers;

use App\Models\KesesuaianBidangKerja;
use Illuminate\Http\Request;

class KesesuaianBidangKerjaController extends Controller
{
    public function index()
    {
        $data = KesesuaianBidangKerja::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun_lulus', 'asc')
                ->get();
                
        return view('kesesuaian_bidang_kerja.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        KesesuaianBidangKerja::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.f.2 (Kesesuaian Bidang Kerja) berhasil disimpan!');
    }

    public function destroy($id)
    {
        KesesuaianBidangKerja::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.f.2 berhasil dihapus!');
    }
}