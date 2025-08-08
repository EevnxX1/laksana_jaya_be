<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_bkb', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kd_transaksi');
            $table->string('uraian');
            $table->double('debit');
            $table->double('kredit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bkb');
    }
};
