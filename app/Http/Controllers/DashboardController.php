<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $total_barang = Barang::count();
        $total_peminjaman = Peminjaman::count();
        $total_user = User::count();
        return view('role_admin.dashboard', [
            'total_barang' => $total_barang,
            'total_peminjaman' => $total_peminjaman,
            'total_user' => $total_user,
        ]);
    }

    public function dashboard_user()
    {
        $user_id = Auth::id();

        $peminjamans = Peminjaman::where('user_id', $user_id)
            ->where('status_hq', 'DITERIMA')
            ->whereDate('created_at', '>=', now()->subHours(24))
            ->get();

        foreach ($peminjamans as $peminjaman) {
            $message = "<i class='fas fa-check-circle'>Aset <u>{$peminjaman->barang->nama}</u>  sudah di Approve. Ambil barang dan tunjukkan <u>Bukti Pinjam</u> ke administrasi kantor. Peringatan berlaku <u>1x24 Jam</u></i> ";
            session()->flash('success', $message);
        }

        $peminjamanDiambil = Peminjaman::where('user_id', $user_id)
            ->where('status_hq', 'DIAMBIL')
            ->whereDate('created_at', '>=', now()->subMinutes(15))
            ->first();

        if ($peminjamanDiambil) {
            $messageDiambil = "<i class='fas fa-check-circle'>Barang sudah diambil. Mohon pergunakan dengan semestinya.</i>";
            session()->flash('info', $messageDiambil);
        }

        return view('role_user.dashboard', ['peminjamans' => $peminjamans]);
    }




    public function dashboard_manager()
    {
        return view('role_manager.dashboard');
    }
    public function dashboard_hq()
    {
        return view('role_hq.dashboard');
    }
}
