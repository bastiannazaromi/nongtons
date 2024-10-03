<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'resfresh');
		}

		// memanggil model dengan nama M_User dan di rename menjadi user
		$this->load->model('M_User', 'user');
	}

	public function index()
	{
		// echo 'Ini adalah halaman user';

		$user = $this->user->getAllUser();

		$data = [
			'title' => 'Halaman User',
			'page'  => 'user/v_user',
			'user'  => $user
		];

		// memanggil view dengan nama v_user
		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Tambah User',
			'page'  => 'user/v_addUser'
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		// xss clean dengan menambahkan TRUE

		$this->form_validation->set_rules('username', 'Username', 'required', [
			'required' => 'Username tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required|alpha_numeric_spaces', [
			'required' => 'Nama tidak boleh kosong!',
			'alpha_numeric_spaces'    => 'Nama harus diisi dengan huruf'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
			'required' => 'Email tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|min_length[4]|max_length[4]|numeric', [
			'required'   => 'Tahun tidak boleh kosong!',
			'min_length' => 'Tahun tidak boleh kurang dari 4 karakter',
			'max_length' => 'Tahun tidak boleh lebih dari 4 karakter',
			'numeric'    => 'Tahun harus diisi dengan angka'
		]);

		if ($this->form_validation->run() == FALSE) {
			$data = [
				'title' => 'Tambah User',
				'page'  => 'user/v_addUser'
			];

			$this->load->view('index', $data);
		} else {
			$username = $this->input->post('username');
			$nama     = $this->input->post('nama');
			$email    = $this->input->post('email');
			$tahun    = $this->input->post('tahun');

			$data = [
				'username' => $username,
				'password' => password_hash('12345678', PASSWORD_BCRYPT),
				'nama'     => $nama,
				'email'    => $email,
				'tahun'    => $tahun
			];

			$insert = $this->user->addUser($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');

				redirect('user', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');

				redirect('user', 'refresh');
			}
		}
	}

	public function edit($id)
	{
		$user = $this->user->getOneUser($id);

		$data = [
			'title' => 'Edit User',
			'page'	=> 'user/v_editUser',
			'user'  => $user
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('username', 'Username', 'required', [
			'required' => 'Username harus diisi!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'required', [
			'required' => 'Nama harus diisi!'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required', [
			'required' => 'Email harus diisi!'
		]);
		$this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|min_length[4]|max_length[4]', [
			'required' => 'Tahun harus diisi!',
			'numeric'  => 'Tahun hanya bisa diisi dengan angka'
		]);

		if ($this->form_validation->run() == false) {
			$user = $this->user->getOneUser($id);

			$data = [
				'title' => 'Edit User',
				'page'  => 'user/v_editUser',
				'user'  => $user
			];

			$this->load->view('index', $data);
		} else {
			$username = $this->input->post('username');
			$nama     = $this->input->post('nama');
			$email    = $this->input->post('email');
			$tahun    = $this->input->post('tahun');

			$data = [
				'username' => $username,
				'nama'     => $nama,
				'email'    => $email,
				'tahun'    => $tahun
			];

			$update = $this->user->editUser($id, $data);

			if ($update) {
				$this->session->set_flashdata('sukses', 'Data berhasil diedit');

				redirect('user', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagak diedit');

				redirect('user', 'refresh');
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->user->delete($id);

		if ($delete) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}
