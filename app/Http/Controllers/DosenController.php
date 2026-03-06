<?php
namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    public function store(Request $request)
    {
        Dosen::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan!');
        
    }
}