<?php

namespace App\Http\Controllers;

use App\Models\JumlahMahasiswa; // <--- PENTING
use Illuminate\Http\Request;

class JumlahMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = JumlahMahasiswa::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('jumlah_mahasiswa.index', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        JumlahMahasiswa::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Jumlah Mahasiswa berhasil disimpan!');
    }

    public function destroy($id)
    {
        JumlahMahasiswa::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}