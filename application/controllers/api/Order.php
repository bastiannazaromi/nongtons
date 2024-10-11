<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Order extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->model('M_Orders', 'orders');
		$this->load->model('M_Jadwal', 'jadwal');
	}

	public function index_post()
	{
		$idUser = $this->post('idUser');
		$idJadwal = $this->post('idJadwal');
		$jumlah = $this->post('jumlah');
		$no_kursi = $this->post('no_kursi');

		$data = [
			'idUser' => $idUser,
			'idJadwal' => $idJadwal,
			'jumlah' => $jumlah,
			'no_kursi' => $no_kursi,
			'harga'    => (40000 * $jumlah)
		];

		$jadwal_tayang = $this->jadwal->getOneJadwal($idJadwal);

		if (!$jadwal_tayang) {
			$this->response([
				'status'  => false,
				'message' => 'Jadwal tayang tidak ditemukan'
			], 400);

			exit;
		}

		$insert = $this->orders->addOrders($data);

		if ($insert) {
			$this->db->where('id', $idJadwal);
			$this->db->update('jadwal_tayang', ['kursiTerjual' => $jadwal_tayang->kursiTerjual + $jumlah]);

			$this->response([
				'status' => true,
				'message' => 'Order Berhasil'
			], 201);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Order Gagal'
			], 500);
		}
	}
}

/* End of file Order.php */
