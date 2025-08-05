<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bkk extends Model
{
    use HasFactory;

    protected $table = 'tbl_bkk';

    protected $fillable = [
        'id_bpbarang',
        'id_bpjasa',
        'identity',
        'identity_uk',
        'tanggal',
        'instansi',
        'pekerjaan',
        'uraian',
        'harga_satuan',
        'volume',
        'satuan',
        'nota',
        'debit',
        'kredit',
        'kb_kas',
        'upah',
        'material_kaskecil',
        'material_kasbesar',
        'non_material',
        'dircost',
        'grand_total',
    ];
}
