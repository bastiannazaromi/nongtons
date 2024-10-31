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
		$idUser   = $this->post('idUser');
		$idJadwal = $this->post('idJadwal');
		$jumlah   = $this->post('jumlah');
		$no_kursi = $this->post('no_kursi');

		$data = [
			'idUser'   => $idUser,
			'idJadwal' => $idJadwal,
			'jumlah'   => $jumlah,
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
				'status'  => true,
				'message' => 'Order Berhasil'
			], 201);
		} else {
			$this->response([
				'status'  => false,
				'message' => 'Order Gagal'
			], 500);
		}
	}

	public function index_get()
	{
		$idUser = $this->get('idUser');

		$orders = $this->orders->getAllOrders(['orders.idUser' => $idUser]);

		$this->response([
			'status'  => true,
			'message' => (count($orders) > 0) ?  'Orders ditemukan' : 'Orders tidak ditemukan',
			'data'    => $orders
		], 200);
	}

	public function detail_get()
	{
		$id = $this->get('id');

		$orders = $this->orders->getOneOrders(['orders.id' => $id]);

		if ($orders) {
			$this->response([
				'status'  => true,
				'message' => 'Orders ditemukan',
				'data'    => $orders
			], 200);
		} else {
			$this->response([
				'status'  => false,
				'message' => 'Orders tidak ditemukan',
				'data'    => []
			], 400);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');

		$orders = $this->orders->getOneOrders(['orders.id' => $id]);

		if (!$orders) {
			$this->response([
				'status'  => false,
				'message' => 'Order tidak ditemukan'
			], 400);

			exit;
		}

		$jadwal_tayang = $this->jadwal->getOneJadwal($orders->idJadwal);

		$jumlah   = $this->put('jumlah');
		$no_kursi = $this->put('no_kursi');

		$data = [
			'jumlah'   => $jumlah,
			'no_kursi' => $no_kursi,
			'harga'    => (40000 * $jumlah)
		];

		$update = $this->orders->updateOrders($data, ['id' => $id]);

		if ($update) {
			$this->db->where('id', $orders->idJadwal);
			$this->db->update('jadwal_tayang', ['kursiTerjual' => ($jadwal_tayang->kursiTerjual + $jumlah) - $orders->jumlah]);

			$this->response([
				'status'  => true,
				'message' => 'Order berhasil diupdate'
			], 200);
		} else {
			$this->response([
				'status'  => false,
				'message' => 'Order gagal diupdate'
			], 500);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		$orders = $this->orders->getOneOrders(['orders.id' => $id]);

		if (!$orders) {
			$this->response([
				'status'  => false,
				'message' => 'Order tidak ditemukan'
			], 400);

			exit;
		}

		$jadwal_tayang = $this->jadwal->getOneJadwal($orders->idJadwal);

		$delete = $this->orders->deleteOrders(['id' => $id]);

		if ($delete) {
			$this->db->where('id', $orders->idJadwal);
			$this->db->update('jadwal_tayang', ['kursiTerjual' => $jadwal_tayang->kursiTerjual - $orders->jumlah]);

			$this->response([
				'status'  => true,
				'message' => 'Order berhasil dihapus'
			], 200);
		} else {
			$this->response([
				'status'  => false,
				'message' => 'Order gagal dihapus'
			], 400);
		}
	}
}

    /* End of file Order.php */
