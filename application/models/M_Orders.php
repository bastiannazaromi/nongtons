<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Orders extends CI_Model
{
	public function getAllOrders($where)
	{
		$this->db->select('orders.*, user.nama, jadwal_tayang.tanggal, jadwal_tayang.jamTayang, film.judul, cinema.namaCinema');

		$this->db->join('user', 'user.id = orders.idUser', 'inner');
		$this->db->join('jadwal_tayang', 'jadwal_tayang.id = orders.idJadwal', 'inner');
		$this->db->join('cinema', 'cinema.id = jadwal_tayang.idCinema', 'inner');
		$this->db->join('film', 'film.id = jadwal_tayang.idFilm', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		$this->db->order_by('orders.createdAt', 'desc');

		return $this->db->get('orders')->result();
	}

	public function addOrders($data)
	{
		return $this->db->insert('orders', $data);
	}

	public function getOneOrders($where)
	{
		$this->db->select('orders.*, user.nama, jadwal_tayang.tanggal, jadwal_tayang.jamTayang, film.judul, cinema.namaCinema');

		$this->db->join('user', 'user.id = orders.idUser', 'inner');
		$this->db->join('jadwal_tayang', 'jadwal_tayang.id = orders.idJadwal', 'inner');
		$this->db->join('cinema', 'cinema.id = jadwal_tayang.idCinema', 'inner');
		$this->db->join('film', 'film.id = jadwal_tayang.idFilm', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		return $this->db->get('orders')->row();
	}

	public function updateOrders($data, $where)
	{
		$this->db->where($where);

		return $this->db->update('orders', $data);
	}

	public function deleteOrders($where)
	{
		return $this->db->delete('orders', $where);
	}
}
/* End of file M_Orders.php */
