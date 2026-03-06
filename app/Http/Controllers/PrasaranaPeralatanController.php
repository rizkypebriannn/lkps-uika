<?php

namespace App\Http\Controllers;

use App\Models\PrasaranaPeralatan; // <--- PENTING: Anti Class Not Found
use Illuminate\Http\Request;

class PrasaranaPeralatanController extends Controller
{
    public function index()
    {
        $prasaranas = PrasaranaPeralatan::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('prasarana_peralatan.index', compact('prasaranas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        PrasaranaPeralatan::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Prasarana & Peralatan berhasil disimpan!');
    }

    public function destroy($id)
    {
        PrasaranaPeralatan::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}