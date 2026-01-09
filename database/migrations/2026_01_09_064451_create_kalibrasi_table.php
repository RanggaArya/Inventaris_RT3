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
    Schema::create('kalibrasi', function (Blueprint $table) {
      $table->id();
      $table->foreignId('perangkat_id')->constrained('perangkats')->onDelete('cascade');
      $table->string('nomor_sertifikat')->nullable();
      $table->string('bulan_order')->nullable();
      $table->string('nomor_order')->nullable();
      $table->foreignId('lokasi_id')->nullable()->constrained('lokasis')->nullOnDelete();
      $table->date('tanggal_kalibrasi')->nullable()->index('tanggal_kalibrasi');
      $table->string('metode')->nullable();
      $table->string('acuan')->nullable();
      $table->string('hasil_kalibrasi')->nullable();
      $table->string('sertifikat_kalibrasi')->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kalibrasi');
  }
};
