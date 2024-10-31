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
}

/* End of file User.php */