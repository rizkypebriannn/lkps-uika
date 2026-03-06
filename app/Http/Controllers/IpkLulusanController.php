<?php

namespace App\Http\Controllers;

use App\Models\IpkLulusan; // <--- PENTING
use Illuminate\Http\Request;

class IpkLulusanController extends Controller
{
    public function index()
    {
        // Mengurutkan agar TS-2 tampil duluan, lalu TS-1, lalu TS
        $ipks = IpkLulusan::where('prodi_id', auth()->user()->prodi_id)
                    ->orderBy('tahun_lulus', 'asc')
                    ->get();
        return view('ipk_lulusan.index', compact('ipks'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['prodi_id'] = auth()->user()->prodi_id; 

        // Cek apakah tahun lulus tersebut sudah diinput sebelumnya untuk prodi ini
        $existing = IpkLulusan::where('prodi_id', auth()->user()->prodi_id)
                              ->where('tahun_lulus', $request->tahun_lulus)
                              ->first();

        if ($existing) {
            // Jika sudah ada, kita update nilainya agar tidak double row
            $existing->update($data);
            return redirect('/dashboard')->with('success', 'Data IPK ' . $request->tahun_lulus . ' berhasil diperbarui!');
        }

        IpkLulusan::create($data);
        return redirect('/dashboard')->with('success', 'Data IPK Lulusan berhasil disimpan!');
    }

    public function destroy($id)
    {
        IpkLulusan::findOrFail($id)->delete();
        return redirect('/dashboard')->with('success', 'Data berhasil dihapus!');
    }
}