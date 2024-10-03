<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Jadwal extends CI_Model
{
	public function addJadwal($data)
	{
		return $this->db->insert('jadwal_tayang', $data);
	}

	public function getAllJadwal()
	{
		$this->db->select('jadwal_tayang.*, cinema.namaCinema, film.judul, film.genre, film.durasi');
		$this->db->join('cinema', 'cinema.id = jadwal_tayang.idCinema', 'inner');
		$this->db->join('film', 'film.id = jadwal_tayang.idFilm', 'inner');

		$this->db->order_by('jadwal_tayang.tanggal', 'desc');

		return $this->db->get('jadwal_tayang')->result();
	}

	public function getOneJadwal($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('jadwal_tayang')->row();
	}

	public function editJadwal($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('jadwal_tayang', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('jadwal_tayang');
	}
}

/* End of file M_Jadwal.php */
