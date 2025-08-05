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
        Schema::create('tbl_bpjasa', function (Blueprint $table) {
            $table->id();
            $table->string('post');
            $table->date('tanggal');
            $table->string('instansi');
            $table->string('tahun_anggaran');
            $table->string('nama_pekerjaan');
            $table->double('nilai_pekerjaan');
            $table->string('sub_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bpjasa');
    }
};
