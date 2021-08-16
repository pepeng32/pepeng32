<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa_tb extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nim'       => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'nama'       => [
				'type'       => 'VARCHAR',
				'constraint' => '250',
			],
			'alamat'       => [
				'type'       => 'VARCHAR',
				'constraint' => '250',
			],
			'foto'       => [
				'type'       => 'VARCHAR',
				'constraint' => '250',
			],
			'created_at'       => [
				'type'       => 'DATETIME',
				'null' => true,
			],
			'updated_at'       => [
				'type'       => 'DATETIME',
				'null' => true,
			],
			'deleted_at'       => [
				'type'       => 'DATETIME',
				'null' => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('mahasiswa_tb');
	}

	public function down()
	{
		$this->forge->dropTable('mahasiswa_tb');
	}
}
