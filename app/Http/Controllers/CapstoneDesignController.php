<?php
namespace App\Http\Controllers;

use App\Models\CapstoneDesign;
use Illuminate\Http\Request;

class CapstoneDesignController extends Controller
{
    public function index()
    {
        // Hanya tampilkan data milik Prodi yang sedang login
        $capstones = CapstoneDesign::where('prodi_id', auth()->user()->prodi_id)
                                   ->orderBy('semester', 'asc')
                                   ->get();
        return view('capstone_design.index', compact('capstones'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Suntikkan ID Prodi sebelum disimpan
        $data['prodi_id'] = auth()->user()->prodi_id; 

        CapstoneDesign::create($data);
        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id)
    {
        $capstone = CapstoneDesign::findOrFail($id);
        $capstone->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}