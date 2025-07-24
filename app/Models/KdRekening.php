<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KdRekening extends Model
{
    use HasFactory;

    protected $table = 'tbl_kdrekening';

    protected $fillable = [
        'id_bpbarang',
        'no_rekening',
        'ket',
    ];
}
