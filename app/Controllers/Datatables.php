<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Datatables extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Datatables',
		];
		return view('datatables/index', $data);
	}

	public function getTable()
	{

		$start = $no = $this->request->getVar('start');
		$length = $this->request->getVar('length');
		$draw = $this->request->getVar('draw');

		$listing = $this->datatablesModel->getDatatables($length, $start);

		foreach ($listing as $l) {
			$no++;
			$row 	= array();
			$row[] 	= $no;
			$row[] 	= $l['nim'];
			$row[] 	= $l['nama'];
			$row[] 	= $l['alamat'];
			$data[] = $row;
		}

		$output = array(
			"draw" => $draw,
			"data" => $data
		);

		return json_encode($output);
	}
}
