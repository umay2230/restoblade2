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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksi_id')->unsigned();
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->enum('metode_pembayaran', ['tunai','transfer','qris'])->default('tunai');
            $table->decimal('total_harga', 20, 2);
            $table->decimal('diskon', 20, 2)->default(0);
            $table->decimal('total_bayar', 20, 2);
            $table->decimal('jumlah_bayar', 20, 2);
            $table->decimal('kembalian', 20, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};