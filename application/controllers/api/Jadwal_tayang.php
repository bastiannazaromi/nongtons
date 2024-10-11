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

		$newJadwal = [];

		foreach ($jadwal as $jdw) {
			array_push($newJadwal, [
				'id' => (int) $jdw->id,
				'idCinema' => (int) $jdw->idCinema,
				'idFilm' => (int) $jdw->idFilm,
				'tanggal' => $jdw->tanggal,
				'jamTayang' => $jdw->jamTayang,
				'jumlahKursi' => (int) $jdw->jumlahKursi,
				'kursiTerjual' => (int) $jdw->kursiTerjual,
				'namaCinema' => $jdw->namaCinema,
				'judul' => $jdw->judul,
				'genre' => $jdw->genre,
				'durasi' => (int) $jdw->durasi
			]);
		}

		$this->response([
			'status'  => true,
			'message' => (count($jadwal) > 0) ?  'Jadwal tayang ditemukan' : 'Jadwal tayang tidak ditemukan',
			'data'    => $newJadwal
		], 200);
	}

	public function detail_get()
	{
		$id = $this->get('id');

		$jadwal = $this->jadwal->getOneJadwal($id);

		if ($jadwal) {
			$this->response([
				'status'  => true,
				'message' => 'Jadwal tayang ditemukan',
				'data'    => $jadwal
			], 200);
		} else {
			$this->response([
				'status'  => false,
				'message' => 'Jadwal tayang tidak ditemukan',
				'data'    => []
			], 400);
		}
	}
}

/* End of file Controllername.php */