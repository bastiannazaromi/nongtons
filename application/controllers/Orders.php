<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'resfresh');
		}

		$this->load->model('M_Jadwal', 'jadwal');
		$this->load->model('M_Orders', 'orders');
	}

	public function index()
	{
		$data = [
			'title'  => 'List Orders',
			'page'   => 'orders/v_orders',
			'orders' => $this->orders->getAllOrders()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$jadwal = $this->jadwal->getAllJadwal();

		$data = [
			'title'  => 'Orders',
			'page'   => 'orders/v_addOrders',
			'jadwal' => $jadwal,
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('idJadwal', 'Judul Film', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Order', 'required|numeric');
		$this->form_validation->set_rules('no_kursi', 'No Kursi', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());

			redirect('orders', 'refresh');
		} else {
			$idJadwal    = $this->input->post('idJadwal');
			$jumlah      = $this->input->post('jumlah');
			$no_kursi     = $this->input->post('no_kursi');

			$data = [
				'idUser'   => $this->session->userdata('user_login')['data']->id,
				'idJadwal' => $idJadwal,
				'jumlah'   => $jumlah,
				'no_kursi' => $no_kursi,
				'harga'    => (40000 * $jumlah)
			];

			$insert = $this->orders->addOrders($data);

			if ($insert) {
				$jadwal_tayang = $this->jadwal->getOneJadwal($idJadwal);

				$this->db->where('id', $idJadwal);
				$this->db->update('jadwal_tayang', ['kursiTerjual' => $jadwal_tayang->kursiTerjual + $jumlah]);

				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');
			}

			redirect('orders', 'refresh');
		}
	}
}

/* End of file Orders.php */
