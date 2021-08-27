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
		$order = $this->request->getVar('order');
		$search = null;

		if (isset($this->request->getVar('search')['value'])) {
			$search = $this->request->getVar('search')['value'];
		}

		$listing = $this->datatablesModel->getDatatables($length, $start, $search, $order);

		foreach ($listing as $l) {
			$no++;
			$row 	= array();
			$row[] 	= $no;
			$row[] 	= $l->nim;
			$row[] 	= $l->nama;
			$row[] 	= $l->alamat;
			$data[] = $row;
		}

		$output = array(
			"draw" => $draw,
			'recordsTotal' => $this->datatablesModel->countAll(),
			'recordsFiltered' => $this->datatablesModel->countFiltered(),
			"data" => $data
		);

		return json_encode($output);
	}
}
