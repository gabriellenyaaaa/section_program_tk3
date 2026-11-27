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
            $t->unsignedTinyInteger('semester')->default(1)->after('mata_kuliah_id');
            $t->unsignedTinyInteger('nilai_tugas')->default(0)->after('semester');
            $t->unsignedTinyInteger('nilai_uts')->default(0)->after('nilai_tugas');
            $t->unsignedTinyInteger('nilai_uas')->default(0)->after('nilai_uts');
        });
    }

    public function down(): void
    {
        Schema::table('nilai', function (Blueprint $t) {
            $t->dropColumn(['semester', 'nilai_tugas', 'nilai_uts', 'nilai_uas']);
        });
    }
};
