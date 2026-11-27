<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;


#[Table('mata_kuliah')]
#[Fillable(['kode', 'nama', 'sks', 'semester', 'dosen_id'])]
class MataKuliah extends Model
{
    public function dosen() 
    { 
        return $this->belongsTo(User::class, 'dosen_id'); 
    }

    public function jadwal() 
    { 
        return $this->hasMany(Jadwal::class); 
    }

    public function peserta()
    {
        return $this->belongsToMany(User::class, 'krs', 'mata_kuliah_id', 'mahasiswa_id')->withTimestamps();
    }

    public function nilaiMahasiswa()
    {
        return $this->hasMany(Nilai::class, 'mata_kuliah_id');
    }

    public function getPeriodeAttribute(): string
    {
        return $this->semester % 2 ? 'Ganjil' : 'Genap';
    }
}
