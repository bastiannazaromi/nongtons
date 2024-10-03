<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Orders extends CI_Model
{
	public function getAllOrders()
	{
		$this->db->select('orders.*, user.nama, jadwal_tayang.tanggal, jadwal_tayang.jamTayang, film.judul, cinema.namaCinema');

		$this->db->join('user', 'user.id = orders.idUser', 'inner');
		$this->db->join('jadwal_tayang', 'jadwal_tayang.id = orders.idJadwal', 'inner');
		$this->db->join('cinema', 'cinema.id = jadwal_tayang.idCinema', 'inner');
		$this->db->join('film', 'film.id = jadwal_tayang.idFilm', 'inner');

		$this->db->order_by('orders.createdAt', 'desc');

		return $this->db->get('orders')->result();
	}

	public function addOrders($data)
	{
		return $this->db->insert('orders', $data);
	}
}

/* End of file M_Orders.php */
