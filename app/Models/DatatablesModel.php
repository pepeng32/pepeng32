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

	//datatables
	protected $column_order = ['id', 'nim', 'nama', 'alamat'];
	protected $column_search = ['nim', 'nama', 'alamat'];
	protected $order = ['id' => 'DESC'];

	public function getData($nim = false)
	{
		if (!$nim) {
			return $this->findAll();
		}
		return $this->where(['nim' => $nim])->first();
	}

	public function getDatatablesQuery($length = null, $start = null, $search = null, $order = null)
	{
		$i = 0;
		foreach ($this->column_search as $item) {
			if (isset($search)) {
				if ($i === 0) {
					$this->groupStart();
					$this->like($item, $search);
				} else {
					$this->orLike($item, $search);
				}
				if (count($this->column_search) - 1 == $i)
					$this->groupEnd();
			}
			$i++;
		}

		if (isset($order)) {
			$this->orderBy(
				$this->column_order[$order['0']['column']],
				$order['0']['dir']
			);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->orderBy(
				key($order),
				$order[key($order)]
			);
		}
	}

	public function getDatatables($length = null, $start = null, $search = null, $order = null)
	{
		$this->getDatatablesQuery($length, $start, $search, $order);
		if ($length != -1)
			$this->limit($length, $start);
		$query = $this->get();
		return $query->getResult();
	}

	public function countFiltered()
	{
		$this->getDatatablesQuery();
		return $this->countAllResults();
	}

	public function countAll()
	{
		return $this->countAllResults();
	}
}
