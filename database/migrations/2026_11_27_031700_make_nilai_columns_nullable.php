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
        Schema::table('nilai', function (Blueprint $t) {
            $t->unsignedTinyInteger('nilai_tugas')->nullable()->default(null)->change();
            $t->unsignedTinyInteger('nilai_uts')->nullable()->default(null)->change();
            $t->unsignedTinyInteger('nilai_uas')->nullable()->default(null)->change();
            $t->unsignedTinyInteger('nilai_angka')->nullable()->change();
            $t->string('nilai_huruf', 2)->nullable()->change();
            $t->decimal('bobot', 3, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        // sengaja kosong: mengembalikan ke NOT NULL akan gagal jika ada nilai kosong
    }
};
