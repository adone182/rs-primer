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
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('surat_id')->nullable();
            $table->unsignedBigInteger('vaksin_id')->nullable();
            $table->string('jenis_surat');
            $table->timestamp('tanggal_pengajuan');
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('surat_id')->references('id')->on('surats')->nullable();
            $table->foreign('vaksin_id')->references('id')->on('vaksins')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};
