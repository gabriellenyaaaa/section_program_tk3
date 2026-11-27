<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;


#[Table('jadwal')]
#[Fillable(['mata_kuliah_id', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan'])]
class Jadwal extends Model
{
    public function mataKuliah() 
    { 
        return $this->belongsTo(MataKuliah::class); 
    }
}
