<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Bp_jasa extends Model
{
    use HasFactory;

    protected $table = 'tbl_bpjasa';

    protected $fillable = [
        'post',
        'tanggal',
        'instansi',
        'tahun_anggaran',
        'nama_pekerjaan',
        'nilai_pekerjaan',
        'sub_kegiatan',
    ];
}
