<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nim'           => '0011223344',   // dipakai sebagai NIDN untuk dosen
            'name'          => 'Dr. Budi Santoso, M.Kom.',
            'username'      => 'Budi',
            'email'         => 'dosen1@kampus.ac.id',
            'role'          => 'dosen',
            'tempat_lahir'  => 'Yogyakarta',
            'tanggal_lahir' => '1980-05-17',
            'password'      => 'dosen1',
        ]);
    }
}
