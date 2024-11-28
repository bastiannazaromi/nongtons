<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Film extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'resfresh');
		}

		$this->load->model('M_Film', 'film');
	}

	public function index()
	{
		$data = [
			'title' => 'Film',
			'page'  => 'film/v_film',
			'film'  => $this->film->getAllFilm()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Film',
			'page'  => 'film/v_addFilm'
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('judul', 'Judul Film', 'required', [
			'required' => 'Judul Film tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('genre', 'Genre Film', 'required', [
			'required' => 'Genre Film tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('durasi', 'Durasi Film', 'required|numeric');
		$this->form_validation->set_rules('sinopsis', 'Sinopsis', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {
			$judul    = $this->input->post('judul');
			$genre    = $this->input->post('genre');
			$durasi   = $this->input->post('durasi');
			$sinopsis = $this->input->post('sinopsis');

			$upload_gambar = $_FILES['gambar']['name'];

			if ($upload_gambar) {
				$this->load->library('upload');
				$config['upload_path']   = './upload/gambar';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 3072;               // 3 mb
				$config['remove_spaces'] = TRUE;
				$config['detect_mime']   = true;
				$config['encrypt_name']  = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());

					redirect('film', 'refresh');
				} else {
					$upload_data = $this->upload->data();

					$data = [
						'judul'    => $judul,
						'genre'    => $genre,
						'durasi'   => $durasi,
						'sinopsis' => $sinopsis,
						'gambar'   => $upload_data['file_name']
					];
				}
			} else {
				$data = [
					'judul'    => $judul,
					'genre'    => $genre,
					'durasi'   => $durasi,
					'sinopsis' => $sinopsis,
				];
			}

			$insert = $this->film->addFilm($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');
			}

			redirect('film', 'refresh');
		}
	}

	public function edit($id)
	{
		$film = $this->film->getOneFilm($id);

		$data = [
			'title' => 'Edit Film',
			'page'  => 'film/v_editFilm',
			'film'  => $film
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('judul', 'Judul Film', 'required', [
			'required' => 'Judul Film tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('genre', 'Genre Film', 'required', [
			'required' => 'Genre Film tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('durasi', 'Durasi Film', 'required|numeric');
		$this->form_validation->set_rules('sinopsis', 'Sinopsis', 'required');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$judul    = $this->input->post('judul');
			$genre    = $this->input->post('genre');
			$durasi   = $this->input->post('durasi');
			$sinopsis = $this->input->post('sinopsis');

			$upload_gambar = $_FILES['gambar']['name'];

			if ($upload_gambar) {
				$this->load->library('upload');
				$config['upload_path']   = './upload/gambar';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 3072;               // 3 mb
				$config['remove_spaces'] = TRUE;
				$config['detect_mime']   = true;
				$config['encrypt_name']  = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());

					redirect('film', 'refresh');
				} else {
					$upload_data = $this->upload->data();

					$data = [
						'judul'    => $judul,
						'genre'    => $genre,
						'durasi'   => $durasi,
						'sinopsis' => $sinopsis,
						'gambar'   => $upload_data['file_name']
					];
				}
			} else {
				$data = [
					'judul'    => $judul,
					'genre'    => $genre,
					'durasi'   => $durasi,
					'sinopsis' => $sinopsis,
				];
			}

			$film = $this->film->getOneFilm($id);

			$update = $this->film->editFilm($id, $data);

			if ($update) {
				if ($upload_gambar) {
					$path = FCPATH . 'upload/gambar/';

					if ($film->gambar != NULL) {
						unlink($path . $film->gambar);
					}
				}

				$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			} else {
				$this->session->set_flashdata('error', 'Data gagal diedit');
			}

			redirect('film', 'refresh');
		}
	}

	public function delete($id)
	{
		$film = $this->film->getOneFilm($id);
		$delete = $this->film->delete($id);

		if ($delete) {
			$path = FCPATH . 'upload/gambar/';

			if ($film->gambar != NULL) {
				unlink($path . $film->gambar);
			}

			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
}

        /* End of file Film.php */
