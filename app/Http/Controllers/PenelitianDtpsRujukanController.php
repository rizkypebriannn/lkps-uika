<?php

namespace App\Http\Controllers;

use App\Models\PenelitianDtpsRujukan;
use Illuminate\Http\Request;

class PenelitianDtpsRujukanController extends Controller
{
    public function index()
    {
        $data = PenelitianDtpsRujukan::where('prodi_id', auth()->user()->prodi_id)
                ->orderBy('tahun', 'desc')
                ->get();
                
        return view('penelitian_dtps_rujukan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['prodi_id'] = auth()->user()->prodi_id; 

        PenelitianDtpsRujukan::create($input);
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.h.2 (Penelitian Rujukan Tesis) berhasil disimpan!');
    }

    public function destroy($id)
    {
        PenelitianDtpsRujukan::findOrFail($id)->delete();
        
        return redirect('/dashboard')->with('success', 'Data Tabel 6.h.2 berhasil dihapus!');
    }
}