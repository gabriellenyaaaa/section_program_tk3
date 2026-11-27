<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['nim', 'name', 'username', 'email', 'role', 'tempat_lahir', 'tanggal_lahir', 'photo', 'ipk', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
        'tanggal_lahir' => 'date',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        ];
    }

    public function nilai() 
    { 
        return $this->hasMany(Nilai::class, 'mahasiswa_id'); 
    }

    public function mataKuliah() 
    { 
        return $this->hasMany(MataKuliah::class, 'dosen_id'); 
    }

    public function kelas()
    {
        return $this->belongsToMany(MataKuliah::class, 'krs', 'mahasiswa_id', 'mata_kuliah_id')->withTimestamps();
    }

    public function hitungIpk(): void
    {
        $rows = $this->nilai()->whereNotNull('bobot')->with('mataKuliah')->get();
        $sks  = $rows->sum(fn ($n) => $n->mataKuliah->sks);
        $mutu = $rows->sum(fn ($n) => $n->bobot * $n->mataKuliah->sks);

        $this->forceFill(['ipk' => $sks ? round($mutu / $sks, 2) : 0])->save();
    }

    public function tagihan() 
    { 
        return $this->hasMany(Tagihan::class, 'mahasiswa_id'); 
    }
}
