<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Buku extends CI_Model
{
	public function getAllBuku()
	{
		$this->db->order_by('nama', 'asc');

		return $this->db->get('user')->result();
	}

	public function getOneBuku($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('user')->row();
	}
}

/* End of file M_Buku.php */
