<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Dompdf\Dompdf;
use Dompdf\Options;

class PeminjamanController extends Controller
{
    public function store(Request $request)
    {
        $barang_id = $request->barang_id;
        $user = Auth::user()->id;

        $barang = Barang::find($barang_id);

        if (!$barang) {
            return back()->with('error', 'Aset tidak ditemukan!');
        }

        if ($request->jumlah_request > $barang->jumlah) {
            Alert::error('Error', 'Jumlah permintaan melebihi stok aset yang tersedia');
            return redirect()->route('barang_user');
        }

        Peminjaman::create([
            'barang_id' => $barang_id,
            'user_id' => $user,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'jumlah_request' => $request->jumlah_request,
            'keperluan' => $request->keperluan,
        ]);

        if ($barang->status_hq === 'DITERIMA') {
            $barang->jumlah -= $request->jumlah_request;
            $barang->save();
        }

        Alert::success('Success', 'Aset berhasil diproses. Silahkan tunggu konfirmasi dari Manager dan HQ untuk proses selanjutnya!');
        return redirect()->route('barang_user');
    }


    public function history()
    {
        $id_user = Auth::user()->id;
        $riwayat_peminjaman = Peminjaman::where('user_id', $id_user)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('peminjaman.historyPeminjamanUser', [
            'riwayat_peminjaman' => $riwayat_peminjaman
        ]);
    }

    public function approval_manager()
    {
        $cabang_id = Auth::user()->cabang_id;
        $peminjaman = Peminjaman::whereHas('user', function ($query) use ($cabang_id) {
            $query->where('cabang_id', $cabang_id);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('peminjaman.approvalPeminjamanManager', [
        'peminjaman' => $peminjaman
    ]);
    }


    public function updateStatusManager(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status_manager = $request->status_manager;

        if ($peminjaman->status_manager === 'DITOLAK') {
            $peminjaman->status_hq = 'SELESAI';
        }
        $peminjaman->save();

        return redirect()->back()->with('success', 'Status manager berhasil diperbarui');
    }


    public function approval_hq()
    {
        $peminjaman = Peminjaman::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('peminjaman.approvalPeminjamanHq', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function updateStatusHq(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status_hq = $request->status_hq;
        $peminjaman->save();


        if ($peminjaman->status_hq === 'SELESAI') {
            $peminjaman->update(['status_manager' => 'SELESAI']);
            $barang = $peminjaman->barang;
            $barang->update([
                'jumlah' => $barang->jumlah + $peminjaman->jumlah_request
            ]);
        } elseif ($peminjaman->status_hq === 'DITERIMA') {
            $barang = $peminjaman->barang;
            $barang->update([
                'jumlah' => $barang->jumlah - $peminjaman->jumlah_request
            ]);
        }

        return redirect()->back()->with('success', 'Status HQ berhasil diperbarui');
    }

    public function listPeminjaman()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman.listPeminjamanAdmin', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function cetak_pdf($id)
    {
        $userId = Auth::user()->id;
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', $userId)
            ->with('barang')
            ->first();
        if (!$peminjaman) {
            abort(403, 'Forbidden');
        }
        $data = [
            'peminjaman' => $peminjaman,
        ];
        return view('peminjaman.cetak_pdf', $data);
    }
}
