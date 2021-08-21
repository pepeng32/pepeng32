<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MahasiswaFakerSeeder extends Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create('id_ID');

		$model = model('MahasiswaModelFaker');
		for ($x = 0; $x <= 500; $x++) {
			$model->insert([
				'nim'       => mt_rand(10000000, 99999999),
				'nama'      => $faker->name,
				'alamat'    => $faker->address,
				'foto'		=> 'default.jpg',
				'created_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
				'updated_at' => $faker->dateTimeThisYear->format('Y-m-d H:i:s')
			]);
		}
	}
}
