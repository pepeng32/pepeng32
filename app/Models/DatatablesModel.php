<?php

namespace App\Models;

use CodeIgniter\Model;

class DatatablesModel extends Model
{
	protected $table                = 'mahasiswa_tb';
	protected $primaryKey           = 'id';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nim', 'nama', 'alamat', 'foto'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getData($nim = false)
	{
		if (!$nim) {
			return $this->findAll();
		}
		return $this->where(['nim' => $nim])->first();
	}

	public function getDatatables($length = null, $start = null)
	{
		return $this->findAll($length, $start);
	}
}
