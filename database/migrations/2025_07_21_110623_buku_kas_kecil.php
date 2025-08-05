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
        Schema::create('tbl_bkk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_bpbarang');
            $table->bigInteger('id_bpjasa');
            $table->string('identity');
            $table->string('identity_uk');
            $table->date('tanggal');
            $table->string('instansi');
            $table->string('pekerjaan');
            $table->string('uraian');
            $table->double('harga_satuan');
            $table->string('volume');
            $table->string('satuan');
            $table->double('kb_kas');
            $table->double('upah');
            $table->double('material_kaskecil');
            $table->double('material_kasbesar');
            $table->double('non_material');
            $table->double('dircost');
            $table->double('grand_total');
            $table->text('nota');
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
        Schema::dropIfExists('tbl_bkk');
    }
};
