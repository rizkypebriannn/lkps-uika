<?php

namespace App\Http\Controllers;

use App\Models\PengakuanDtps; // <--- PENTING: Anti Error
use Illuminate\Http\Request;

class PengakuanDtpsController extends Controller
{
    public function index()
    {
        $pengakuans = PengakuanDtps::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('pengakuan_dtps.index', compact('pengakuans'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PengakuanDtps::create($data);
        
        // Auto-Redirect ke Dashboard
        return redirect('/dashboard')->with('success', 'Data Pengakuan/Rekognisi DTPS berhasil disimpan!');
    }

    public function destroy($id)
    {
        PengakuanDtps::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}