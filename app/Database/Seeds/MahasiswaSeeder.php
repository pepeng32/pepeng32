<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nim'       => '123123',
                'nama'      => 'pepeng',
                'alamat'    => 'klaten',
                'foto'      => 'default.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ],
            [
                'nim'       => '123456',
                'nama'      => 'piping',
                'alamat'    => 'kla',
                'foto'      => 'default.jpg',
                'created_at' => Time::now(),
                'updated_at' => Time::now()
            ]
        ];

        // Simple Queries
        // $this->db->query("INSERT INTO mahasiswa2_tb (nim, nama, alamat, created_at, updated_at) VALUES(:nim:, :nama:, :alamat:, :created_at:, :updated_at:)", $data);

        // Using Query Builder
        // $this->db->table('mahasiswa2_tb')->insert($data);
        $this->db->table('mahasiswa2_tb')->insertBatch($data);
    }
}
