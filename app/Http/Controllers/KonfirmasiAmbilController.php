<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KonfirmasiAmbilController extends Controller
{
    public function konfirmasiAmbil ()
    {
        $peminjaman = Peminjaman::all();
        return view('pengambilan.listPengambilanBarang', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function updateStatusKonfirmasiAmbil(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($request->status === 'DIAMBIL') {
            $peminjaman->status_manager = 'DIAMBIL';
            $peminjaman->status_hq = 'DIAMBIL';
            $peminjaman->save();
        }

        if ($request->status === 'DITERIMA') {
            $peminjaman->status_manager = 'DITERIMA';
            $peminjaman->status_hq = 'DITERIMA';
            $peminjaman->save();
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui menjadi DIAMBIL');
    }

}
