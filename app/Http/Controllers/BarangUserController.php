<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangUserController extends Controller
{
    public function index(Request $request)
    {
        $keyword_search = $request->input('keyword_search');
        $id_user = Auth::id();

        $barangs = Barang::select(
            'barangs.*',
            DB::raw("(SELECT
                CASE
                    WHEN MIN(peminjaman.status_hq) = 'DITERIMA' THEN 'DITERIMA'
                    WHEN MIN(peminjaman.status_hq) = 'DIAMBIL' THEN 'DITERIMA'
                    WHEN MIN(peminjaman.status_hq) = 'PROSES' THEN 'PROSES'
                    ELSE 'SELESAI'
                END
            FROM peminjaman
            WHERE peminjaman.barang_id = barangs.id
            AND peminjaman.user_id = {$id_user}) as status_peminjaman")
        )
            ->where(function ($query) use ($keyword_search) {
                $query->where('barangs.nama', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.kode', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.jumlah', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.kondisi', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.brand', 'like', '%' . strtolower($keyword_search) . '%')
                    ->orWhere('barangs.nilai_harga', 'like', '%' . strtolower($keyword_search) . '%');
            })
            ->paginate(10);

        return view('barang_user.listBarangUser', ['barangs' => $barangs, 'keyword_search' => $keyword_search]);
    }

}
