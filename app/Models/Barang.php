<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = "barangs";
    protected $fillable = [
        'kode',
        'nama',
        'jumlah',
        'satuan',
        'tanggal_pembelian',
        'nilai_harga',
        'brand',
        'kondisi',
        'gambar',
        'aktif',
        'detail_tempat',
        'status_persetujuan_manager',
        'status_persetujuan_hq',
    ];
}
