<?php
namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        // GEMBOK KEAMANAN: Hanya ambil data Visi Misi milik Prodi yang sedang login
        $visiMisis = \App\Models\VisiMisi::where('prodi_id', auth()->user()->prodi_id)->get();
        
        // Kirim datanya ke halaman view dengan nama variabel yang sesuai
        return view('visi_misi.index', compact('visiMisis'));
    }
    
    public function store(Request $request)
    {
        VisiMisi::create($request->all());
       return redirect('/dashboard')->with('success', 'Data berhasil disimpan!');
    }
    // 1. Fungsi untuk membuka halaman Edit
    public function edit($id)
    {
        // Pastikan hanya bisa diedit oleh Prodi yang bersangkutan
        $visiMisi = \App\Models\VisiMisi::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        return view('visi_misi.edit', compact('visiMisi'));
    }

    // 2. Fungsi untuk menyimpan perubahan (Update)
    public function update(Request $request, $id)
    {
        $visiMisi = \App\Models\VisiMisi::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();

        $visiMisi->update($request->all());

        return redirect()->route('visi_misi.index')->with('success', 'Data Visi Misi berhasil diperbarui!');
    }

    // 3. Fungsi untuk menghapus data (Destroy)
    public function destroy($id)
    {
        $visiMisi = \App\Models\VisiMisi::where('id', $id)
                        ->where('prodi_id', auth()->user()->prodi_id)
                        ->firstOrFail();
                        
        $visiMisi->delete();

        return redirect()->back()->with('success', 'Data Visi Misi berhasil dihapus!');
    }
}