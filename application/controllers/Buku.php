<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('M_Buku', 'buku');
	}

	public function index()
	{
		$buku = $this->buku->getAllBuku();

		$data = [
			'title' => 'Halaman Buku',
			'page'  => 'buku/v_buku',
			'buku'  => $buku
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Tambah Buku',
			'page'  => 'buku/v_addBuku'
		];

		$this->load->view('index', $data);
	}

	public function edit($id)
	{
		$buku = $this->buku->getOneBuku($id);

		$data = [
			'title' => 'Edit Buku',
			'page'	=> 'buku/v_editBuku',
			'buku'  => $buku
		];

		$this->load->view('index', $data);
	}
}

/* End of file Buku.php */
