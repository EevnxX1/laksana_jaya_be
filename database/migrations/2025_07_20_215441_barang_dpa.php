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
        Schema::create('tbl_barangdpa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bpbarang');
            $table->string('nama_barang');
            $table->string('spesifikasi');
            $table->string('vol');
            $table->string('satuan');
            $table->double('harga_satuan');
            $table->double('harga_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barangdpa');
    }
};
