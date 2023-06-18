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
            $table->unsignedBigInteger('imunisasi_id')->nullable();
            $table->unsignedBigInteger('visum_id')->nullable();
            $table->unsignedBigInteger('medis_id')->nullable();
            $table->unsignedBigInteger('lahir_id')->nullable();
            $table->unsignedBigInteger('rawat_jalan_id')->nullable();
            $table->unsignedBigInteger('kematian_id')->nullable();
            $table->unsignedBigInteger('asuransi_id')->nullable();
            $table->string('jenis_surat');
            $table->timestamp('tanggal_pengajuan');
            $table->enum('status', ['PENDING', 'DIPROSES', 'SELESAI'])->default('PENDING');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('surat_id')->references('id')->on('surats')->nullable();
            $table->foreign('vaksin_id')->references('id')->on('vaksins')->nullable();
            $table->foreign('imunisasi_id')->references('id')->on('imunisasis')->nullable();
            $table->foreign('visum_id')->references('id')->on('visums')->nullable();
            $table->foreign('medis_id')->references('id')->on('medis')->nullable();
            $table->foreign('lahir_id')->references('id')->on('lahirs')->nullable();
            $table->foreign('rawat_jalan_id')->references('id')->on('rawat_jalans')->nullable();
            $table->foreign('kematian_id')->references('id')->on('kematians')->nullable();
            $table->foreign('asuransi_id')->references('id')->on('asuransis')->nullable();
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
