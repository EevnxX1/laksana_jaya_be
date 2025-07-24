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
        Schema::create('tbl_bkk_barang', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bpbarang');
            $table->date('tanggal');
            $table->string('instansi');
            $table->string('pekerjaan');
            $table->string('nama_barang');
            $table->double('harga_satuan');
            $table->string('volume');
            $table->string('satuan');
            $table->text('nota');
            $table->double('harga_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bkk_barang');
    }
};
