<?php

namespace App\Http\Controllers;

use App\Models\PembimbingLapangan; // <--- PENTING: Anti Class Not Found
use Illuminate\Http\Request;

class PembimbingLapanganController extends Controller
{
    public function index()
    {
        $pembimbings = PembimbingLapangan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('pembimbing_lapangan.index', compact('pembimbings'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PembimbingLapangan::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Pembimbing Lapangan berhasil disimpan!');
    }

    public function destroy($id)
    {
        PembimbingLapangan::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}