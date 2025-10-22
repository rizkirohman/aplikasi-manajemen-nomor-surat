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
        Schema::create('nomor_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->foreignId('jenis_nomor_id')->constrained('jenis_nomor_surats')->onDelete('cascade');
            $table->integer('nomor_start');
            $table->integer('nomor_end')->nullable();
            $table->string('perihal_surat');
            $table->string('tujuan_surat');
            $table->timestamps();

            $table->unique(['jenis_nomor_id', 'nomor_start'], 'unique_jenis_nomor_nomor_start');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_surats');
    }
};
