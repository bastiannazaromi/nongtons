<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->model('M_User', 'user');
	}

	public function index_get()
	{
		$user = $this->user->getAllUser();

		$newUser = [];

		foreach ($user as $u) {
			array_push($newUser, [
				'id'       => (int) $u->id,
				'nama'     => $u->nama,
				'email'    => $u->email,
				'username' => $u->username,
				'tahun'    => (int) $u->tahun,
			]);
		}

		$this->response([
			'status'  => true,
			'message' => (count($user) > 0) ?  'User ditemukan' : 'User tidak ditemukan',
			'data'    => $newUser
		], 200);
	}

	public function login_post()
	{
		$username = $this->post('username');
		$password = $this->post('password');

		if (!$username || !$password) {
			$this->response([
				'status'  => false,
				'message' => 'Username dan password wajib diisi'
			], 400);

			exit;
		}

		$this->db->where('username', $username);
		$this->db->where('role', 2);

		$data = $this->db->get('user')->row();

		if ($data) {
			if (password_verify($password, $data->password)) {
				$msg = 'Login berhasil';

				$this->response([
					'status'  => true,
					'message' => $msg,
					'data'    => $data
				], 200);
			} else {
				$msg = 'Username atau password salah';

				$this->response([
					'status'  => false,
					'message' => $msg
				], 200);
			}
		} else {
			$msg = 'Username atau password salah';

			$this->response([
				'status'  => false,
				'message' => $msg
			], 200);
		}
	}
}

/* End of file User.php */