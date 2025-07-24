<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangDpa extends Model
{
    use HasFactory;

    protected $table = 'tbl_barangdpa';

    protected $fillable = [
        'id_bpbarang',
        'nama_barang',
        'spesifikasi',
        'vol',
        'satuan',
        'harga_satuan',
        'harga_total',
    ];
}
