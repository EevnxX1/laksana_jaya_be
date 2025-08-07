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
        Schema::create('tbl_bpbarang', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('post');
            $table->string('nomor_sp');
            $table->date('tgl_sp');
            $table->string('instansi');
            $table->string('pekerjaan');
            $table->string('sub_kegiatan');
            $table->string('tahun_anggaran');
            $table->date('mulai_pekerjaan');
            $table->date('selesai_pekerjaan');
            $table->string('label_pekerjaan');
            $table->double('nilai_pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bpbarang');
    }
};
