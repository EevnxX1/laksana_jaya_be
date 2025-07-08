<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bkk extends Model
{
    use HasFactory;

    protected $table = 'tbl_bkk';

    protected $fillable = [
        'tanggal',
        'uraian',
        'debit',
        'kredit',
        'saldo',
    ];
}
