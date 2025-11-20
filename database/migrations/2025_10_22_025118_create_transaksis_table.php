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
        Schema::create('transaksis', function (Blueprint $table) {
           $table->id();
           $table->string('nama_customer');
           $table->integer('nomor_meja');
           $table->dateTime('tgl_transaksi', precision: 0);
           $table->enum(('status'), ['dalam antrian', 'menunggu pembayaran','terbayar','pembuatan','pengantaran', 'selesai'])->default('dalam antrian');
           $table->bigInteger('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};