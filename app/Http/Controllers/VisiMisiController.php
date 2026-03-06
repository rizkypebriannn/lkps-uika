<?php
namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisis = VisiMisi::all();
        return view('visi_misi.index', compact('visiMisis'));
    }

    public function store(Request $request)
    {
        VisiMisi::create($request->all());
       return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
}