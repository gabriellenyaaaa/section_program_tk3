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
        Schema::create('mata_kuliah', function (Blueprint $t) {
            $t->id();
            $t->string('kode', 10)->unique();
            $t->string('nama');
            $t->unsignedTinyInteger('sks');
            $t->foreignId('dosen_id')->constrained('users')->cascadeOnDelete();
            $t->timestamps();
        });

        Schema::create('jadwal', function (Blueprint $t) {
            $t->id();
            $t->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
            $t->string('hari', 10);
            $t->time('jam_mulai');
            $t->time('jam_selesai');
            $t->string('ruangan', 50);
            $t->timestamps();
        });

        Schema::create('nilai', function (Blueprint $t) {
            $t->id();
            $t->foreignId('mahasiswa_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
            $t->unsignedTinyInteger('nilai_angka');
            $t->string('nilai_huruf', 2);
            $t->decimal('bobot', 3, 2);
            $t->timestamps();
            $t->unique(['mahasiswa_id', 'mata_kuliah_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('mata_kuliah');
    }
};
