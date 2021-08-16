<?php

namespace App\Controllers;

class Mahasiswa extends BaseController
{

	public function index()
	{
		//pagination numbering
		$currentPage = $this->request->getVar('page');
		$startNumber = 1;
		if ($currentPage) {
			if ('1' !== $currentPage) {
				$startNumber = ($currentPage - 1) * 6 + 1;
			}
		}

		//search
		$keyword = $this->request->getVar('keyword');
		if ($keyword) {
			$mahasiswa = $this->mahasiswaModel->like('nama', $keyword)->orLike('alamat', $keyword);
			$this->session->setFlashdata('keyword', $keyword);
		} else {
			$mahasiswa = $this->mahasiswaModel;
			$this->session->remove('keyword', $keyword);
		}

		$data = [
			'title' => 'Data Mahasiswa',
			'mahasiswa' => $mahasiswa->paginate(6, 'default'),
			'pager' => $mahasiswa->pager,
			'startNumber' => $startNumber
		];
		return view('mahasiswa/index', $data);
	}

	public function detail($nim)
	{
		$data = [
			'title' => 'Detail Mahasiswa',
			'mahasiswa' => $this->mahasiswaModel->getData($nim)
		];
		return view('mahasiswa/detail', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Tambah Data',
			'validation' => $this->validation
		];
		return view('mahasiswa/create', $data);
	}

	public function save()
	{
		if (!$this->validate([
			'nim' => [
				'rules' => 'required|is_unique[mahasiswa_tb.nim]',
				'errors' => [
					'required' => 'Field {field} is required',
					'is_unique' => 'Field {field} is already used'
				]
			],
			'foto' => [
				'rules' => 'max_size[foto,1024]
							|is_image[foto]
							|mime_in[foto,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Your photo is too large',
					'is_image' => 'Your choosen file is not a photo',
					'mime_in' => 'Your choosen file is not a photo'
				]
			]
		])) {
			return redirect()->to('/create')->withInput();
		}

		//grab file
		$fileFoto = $this->request->getFile('foto');

		if (!$fileFoto->isValid()) {
			$namaFoto = 'default.jpg';
		} else {
			$namaFoto = $this->request->getVar('nim') . '.' . $fileFoto->guessExtension();
			$fileFoto->move('foto', $namaFoto);
		}

		$this->mahasiswaModel->save([
			'nim' => $this->request->getVar('nim'),
			'nama' => $this->request->getVar('nama'),
			'alamat' => $this->request->getVar('alamat'),
			'foto' => $namaFoto
		]);

		session()->setFlashdata('message', 'Data berhasil ditambahkan');

		return redirect()->to('/');
	}

	public function delete($id)
	{
		//get nama foto
		$mahasiswa = $this->mahasiswaModel->find($id);

		//delete foto
		if ($mahasiswa['foto'] != 'default.jpg') {
			unlink('foto/' . $mahasiswa['foto']);
		}

		//delete record
		$this->mahasiswaModel->delete($id);
		session()->setFlashdata('message', 'Data berhasil dihapus');
		return redirect()->to('/');
	}

	public function edit($nim)
	{
		$data = [
			'title' => 'Edit Data',
			'validation' => $this->validation,
			'mahasiswa' => $this->mahasiswaModel->getData($nim)
		];
		return view('mahasiswa/edit', $data);
	}

	public function update($id)
	{
		$nimOld = $this->request->getVar('nimOld');
		$nimNew = $this->request->getVar('nim');

		if ($nimOld == $nimNew) {
			$ruleNim = 'required';
		} else {
			$ruleNim = 'required|is_unique[mahasiswa_tb.nim]';
		}

		if (!$this->validate([
			'nim' => [
				'rules' => $ruleNim,
				'errors' => [
					'required' => '{field} is required',
					'is_unique' => '{field} is already used'
				]
			],
			'foto' => [
				'rules' => 'max_size[foto,1024]
							|is_image[foto]
							|mime_in[foto,image/jpg,image/jpeg,image/png]',
				'errors' => [
					'max_size' => 'Your photo is too large',
					'is_image' => 'Your choosen file is not a photo',
					'mime_in' => 'Your choosen file is not a photo'
				]
			]
		])) {
			return redirect()->to('/edit/' . $nimOld)->withInput();
		}

		//grab file
		$fileFoto = $this->request->getFile('foto');
		$fotoOld = $this->request->getVar('fotoOld');

		if (!$fileFoto->isValid()) {
			$namaFoto = $fotoOld;
		} else {
			$mahasiswa = $this->mahasiswaModel->find($id);

			//delete foto
			if ($mahasiswa['foto'] != 'default.jpg') {
				unlink('foto/' . $mahasiswa['foto']);
			}

			//ganti foto
			$namaFoto = $this->request->getVar('nim') . '.' . $fileFoto->guessExtension();
			$fileFoto->move('foto', $namaFoto);
		}

		$this->mahasiswaModel->save([
			'id' => $id,
			'nim' => $this->request->getVar('nim'),
			'nama' => $this->request->getVar('nama'),
			'alamat' => $this->request->getVar('alamat'),
			'foto' => $namaFoto
		]);

		session()->setFlashdata('message', 'Data berhasil diubah');

		return redirect()->to('/');
	}
}
