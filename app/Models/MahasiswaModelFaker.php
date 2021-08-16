<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModelFaker extends Model
{
	protected $table                = 'mahasiswa_tb';
	protected $primaryKey           = 'id';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nim', 'nama', 'alamat', 'foto', 'created_at', 'updated_at'];

	// Dates
	// protected $useTimestamps        = true;
	// protected $dateFormat           = 'datetime';
	// protected $createdField         = 'created_at';
	// protected $updatedField         = 'updated_at';
	// protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;
}
