<?php

namespace App\Http\Controllers;

use App\Models\FasilitasK3l; // <--- PENTING: Anti Class Not Found
use Illuminate\Http\Request;

class FasilitasK3lController extends Controller
{
    public function index()
    {
        $fasilitas = FasilitasK3l::where('prodi_id', auth()->user()->prodi_id)->get();
        return view('fasilitas_k3l.index', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        FasilitasK3l::create($data);
        
        return redirect('/dashboard')->with('success', 'Data Fasilitas K3L berhasil disimpan!');
    }

    public function destroy($id)
    {
        FasilitasK3l::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}