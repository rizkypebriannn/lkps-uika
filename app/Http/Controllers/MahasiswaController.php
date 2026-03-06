<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        Mahasiswa::create($request->all());
       return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
}