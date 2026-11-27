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
    Schema::create('krs', function (Blueprint $t) {
        $t->id();
        $t->foreignId('mahasiswa_id')->constrained('users')->cascadeOnDelete();
        $t->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
        $t->timestamps();
        $t->unique(['mahasiswa_id', 'mata_kuliah_id']);
    });

    // Daftarkan otomatis mahasiswa yang sudah punya nilai
    DB::statement('INSERT IGNORE INTO krs (mahasiswa_id, mata_kuliah_id, created_at, updated_at)
                    SELECT DISTINCT mahasiswa_id, mata_kuliah_id, NOW(), NOW() FROM nilai');
    }

    public function down(): void
    {
        Schema::dropIfExists('krs');
    }
};
