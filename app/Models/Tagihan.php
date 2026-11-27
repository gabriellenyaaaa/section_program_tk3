<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $fillable = [
        'mahasiswa_id', 'semester', 'keterangan', 'jumlah',
        'jatuh_tempo', 'status', 'tanggal_bayar',
    ];

    protected function casts(): array
    {
        return ['jatuh_tempo' => 'date', 'tanggal_bayar' => 'date'];
    }

    public function mahasiswa() { return $this->belongsTo(User::class, 'mahasiswa_id'); }
}
