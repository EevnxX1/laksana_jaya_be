<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BkkBarang extends Model
{
    use HasFactory;

    protected $table = 'tbl_bkk_barang';

    protected $fillable = [
        'id_bpbarang',
        'tanggal',
        'instansi',
        'pekerjaan',
        'nama_barang',
        'harga_satuan',
        'volume',
        'satuan',
        'nota',
        'harga_total',
    ];
}
