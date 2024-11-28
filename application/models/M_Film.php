<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Film extends CI_Model
{
	public function getAllFilm()
	{
		$this->db->order_by('judul', 'asc');

		return $this->db->get('film')->result();
	}

	public function addFilm($data)
	{
		return $this->db->insert('film', $data);
	}

	public function getOneFilm($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('film')->row();
	}

	public function editFilm($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('film', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('film');
	}
}

/* End of file M_Film.php */
