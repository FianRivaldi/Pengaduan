<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use App\Models\Petugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Masyarakat::create([
            'nik' => '376665242676',
            'nama' => 'fulan',
            'username' => 'fulan2',
            'password' => bcrypt('1234567'),
            'telp' => '099876525',
            'jenis_kelamin' => 'perempuan',
            'alamat' => 'Sindangsari'
        ]);
        \App\Models\Petugas::create([
            'nama_petugas' => 'PetugasA',
            'username' => 'Petugas1',
            'password' => bcrypt('4321'),
            'telp' => '9999999999',
            'level' => 'petugas'
        ]);
        \App\Models\Petugas::create([
            'nama_petugas' => 'Admin',
            'username' => 'Admin',
            'password' => bcrypt('1234'),
            'telp' => '88888',
            'level' => 'admin'
        ]);

        // $user = [
        //     'nik' => '376665242676',
        //     'nama' => 'fulan',
        //     'username' => 'fulan2',
        //     'password' => bcrypt('1234567'),
        //     'telp' => '099876525',
        //     'jenis_kelamin' => 'perempuan',
        //     'alamat' => 'Sindangsari'
        // ];

        // $admin = [
        //     [
        //         'nama_petugas' => 'PetugasA',
        //         'username' => 'Petugas1',
        //         'password' => bcrypt('4321'),
        //         'telp' => '9999999999',
        //         'level' => 'petugas'
        //     ],

        //     [
        //         'nama_petugas' => 'Admin',
        //         'username' => 'Admin',
        //         'password' => bcrypt('1234'),
        //         'telp' => '88888',
        //         'level' => 'admin'
        //     ]

        // ];

        // foreach ($user as $key => $value) {
        //     Masyarakat::create($value);
        // }
        // foreach ($admin as $key => $value) {
        //     Petugas::create($value);
        // }
    }
}
