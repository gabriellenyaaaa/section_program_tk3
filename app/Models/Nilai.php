<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;


#[Table('nilai')]
#[Fillable(['mahasiswa_id', 'mata_kuliah_id', 'semester',
'nilai_tugas', 'nilai_uts', 'nilai_uas',
'nilai_angka', 'nilai_huruf', 'bobot'])]

class Nilai extends Model
{
    public function mahasiswa() 
    { 
        return $this->belongsTo(User::class, 'mahasiswa_id'); 
    }

    public function mataKuliah() 
    { 
        return $this->belongsTo(MataKuliah::class); 
    }

    // Konversi angka -> [huruf, bobot]
    public static function konversi(int $angka): array
    {
        return match (true) {
            $angka >= 80 => ['A', 4.00],
            $angka >= 70 => ['B', 3.00],
            $angka >= 60 => ['C', 2.00],
            $angka >= 50 => ['D', 1.00],
            default      => ['E', 0.00],
        };
    }

    // Setiap nilai disimpan/dihapus -> IPK mahasiswa dihitung ulang
    protected static function booted(): void
    {
        static::saved(fn ($n) => $n->mahasiswa?->hitungIpk());
        static::deleted(fn ($n) => $n->mahasiswa?->hitungIpk());
    }

    public function hitungAkhir(): void
    {
        if (is_null($this->nilai_tugas) || is_null($this->nilai_uts) || is_null($this->nilai_uas)) {
            $this->nilai_angka = null;
            $this->nilai_huruf = null;
            $this->bobot = null;
            return;
        }

        // 30% tugas + 30% UTS + 40% UAS
        $akhir = (int) round($this->nilai_tugas * 0.3 + $this->nilai_uts * 0.3 + $this->nilai_uas * 0.4);
        [$huruf, $bobot] = self::konversi($akhir);

        $this->nilai_angka = $akhir;
        $this->nilai_huruf = $huruf;
        $this->bobot = $bobot;
    }
}
