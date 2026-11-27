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
        Schema::create('tagihans', function (Blueprint $t) {
            $t->id();
            $t->foreignId('mahasiswa_id')->constrained('users')->cascadeOnDelete();
            $t->unsignedTinyInteger('semester');
            $t->string('keterangan');
            $t->unsignedInteger('jumlah');
            $t->date('jatuh_tempo');
            $t->enum('status', ['belum', 'lunas'])->default('belum');
            $t->date('tanggal_bayar')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
