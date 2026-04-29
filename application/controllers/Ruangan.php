<?php

class Ruangan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		checkAksesModule();
		$this->load->library('ssp');
		$this->load->model('model_ruangan');
	}

	function data()
	{

		// nama table
		$table      = 'tbl_ruangan';
		// nama PK
		$primaryKey = 'kd_ruangan';
		// list field yang mau ditampilkan
		$columns    = array(
			//tabel db(kolom di database) => dt(nama datatable di view)
			array('db' => 'kd_ruangan', 'dt' => 'kd_ruangan'),
			array('db' => 'nama_ruangan', 'dt' => 'nama_ruangan'),
			//untuk menampilkan aksi(edit/delete dengan parameter kode ruangan)
			array(
				'db' => 'kd_ruangan',
				'dt' => 'aksi',
				'formatter' => function ($d) {
					return anchor('ruangan/edit/' . $d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"') . ' 
		               		' . anchor('ruangan/delete/' . $d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger btn-hapus" data-placement="top" title="Delete"');
				}
			)
		);

		$sql_details = array(
			'user' => $this->db->username,
			'pass' => $this->db->password,
			'db'   => $this->db->database,
			'host' => $this->db->hostname
		);

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode(
				SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
			));
	}

	function index()
	{
		$this->template->load('template', 'ruangan/view');
	}

	function add()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$kd_ruangan = $this->input->post('kd_ruangan', true);

			// Cek apakah kd_ruangan sudah ada
			$cek = $this->db->get_where('tbl_ruangan', ['kd_ruangan' => $kd_ruangan])->row();
			if ($cek) {
				$this->session->set_flashdata('error', 'Kode ruangan sudah terdaftar!');
				redirect('ruangan/add');
			}

			$this->model_ruangan->save();
			$this->session->set_flashdata('success', 'Data berhasil disimpan!');
			redirect('ruangan');
		} else {
			$this->template->load('template', 'ruangan/add');
		}
	}

	function edit()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->model_ruangan->update();
			$this->session->set_flashdata('success', 'Data berhasil diperbarui!');
			redirect('ruangan');
		} else {
			$kode_ruangan	 = $this->uri->segment(3);
			if (empty($kode_ruangan)) {
				redirect('ruangan');
			}

			$data['ruangan'] = $this->db->get_where('tbl_ruangan', array('kd_ruangan' => $kode_ruangan))->row_array();
			if (!$data['ruangan']) {
				$this->session->set_flashdata('error', 'Data tidak ditemukan!');
				redirect('ruangan');
			}

			$this->template->load('template', 'ruangan/edit', $data);
		}
	}

	function delete()
	{
		$kode_ruangan = $this->uri->segment(3);
		if (!empty($kode_ruangan)) {
			$this->db->where('kd_ruangan', $kode_ruangan);
			$this->db->delete('tbl_ruangan');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		}
		redirect('ruangan');
	}
}
