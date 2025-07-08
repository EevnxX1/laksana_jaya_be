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
            $table->date('tanggal');
            $table->string('uraian');
            $table->string('debit');
            $table->string('kredit');
            $table->string('saldo');
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
