<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bp_barang extends Model
{
    use HasFactory;

    protected $table = 'tbl_bpbarang';

    protected $fillable = [
        'tanggal',
        'post',
        'nomor_sp',
        'tgl_sp',
        'instansi',
        'pekerjaan',
        'sub_kegiatan',
        'tahun_anggaran',
        'mulai_pekerjaan',
        'selesai_pekerjaan',
        'label_pekerjaan',
    ];
}
