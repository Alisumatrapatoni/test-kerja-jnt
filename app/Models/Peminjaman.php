<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'tanggal_pinjam', 'tanggal_kembali', 'status', 'aktif', 'keperluan', 'jumlah_request',
        'user_id', 'barang_id', 'created_at', 'updated_at'
    ];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
