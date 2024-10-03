<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Jadwal_tayang extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->model('M_Jadwal', 'jadwal');
	}

	public function index_get()
	{
		$jadwal = $this->jadwal->getAllJadwal();

		$this->response([
			'status'  => true,
			'message' => 'Jadwal tayang ditemukan',
			'data'    => $jadwal
		], 200);
	}
}

/* End of file Controllername.php */