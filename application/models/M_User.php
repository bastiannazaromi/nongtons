<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_User extends CI_Model
{
	public function getAllUser()
	{
		// queri sql
		// SELECT * FROM user;

		// query builder
		return $this->db->get('user')->result();
	}

	// mengambil 1 data user berdasarkan id
	public function getOneUser($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('user')->row();
	}

	// untuk hapus data user
	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('user');
	}

	// untuk tambah data user
	public function addUser($data)
	{
		return $this->db->insert('user', $data);
	}

	// untuk edit data user
	public function editUser($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('user', $data);
	}
}
