<?php

namespace App\Http\Controllers;

use App\Models\KaryaIlmiahDtps; // <--- DIJAMIN AMAN
use Illuminate\Http\Request;

class KaryaIlmiahDtpsController extends Controller
{
    public function index()
    {
        $karyas = KaryaIlmiahDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('karya_ilmiah_dtps.index', compact('karyas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 
        
        // Auto-kalkulasi total
        $data['jumlah_total'] = $data['jumlah_ts2'] + $data['jumlah_ts1'] + $data['jumlah_ts'];

        KaryaIlmiahDtps::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Karya Ilmiah & Pameran berhasil disimpan!');
    }

    public function destroy($id)
    {
        KaryaIlmiahDtps::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data Karya Ilmiah berhasil dihapus!');
    }
}