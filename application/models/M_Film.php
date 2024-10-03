<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Film extends CI_Model
{
	public function getAllFilm()
	{
		$this->db->order_by('judul', 'asc');

		return $this->db->get('film')->result();
	}
}

/* End of file M_Film.php */
