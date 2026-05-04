<?php

	class Kelas extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			checkAksesModule();
			$this->load->library('ssp');
			$this->load->library('form_validation');
			$this->load->model('model_kelas');
		}

		function data()
		{
			// nama table
			$table      = 'view_kelas';
			// nama PK
			$primaryKey = 'kd_kelas';
			// list field yang mau ditampilkan
			$columns    = array(
				//tabel db(kolom di database) => dt(nama datatable di view)
				array('db' => 'kd_kelas', 'dt' => 'kd_kelas'),
				array('db' => 'nama_kelas', 'dt' => 'nama_kelas'),
				array('db' => 'nama_tingkatan', 'dt' => 'nama_tingkatan'),
				array('db' => 'nama_jurusan', 'dt' => 'nama_jurusan'),
				//untuk menampilkan aksi(edit/delete dengan parameter kode kelas)
				array(
					'db' => 'kd_kelas',
					'dt' => 'aksi',
					'formatter' => function($d) {
						return anchor('kelas/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
						'.anchor(
							'kelas/delete/'.$d,
							'<i class="fa fa-times fa fa-white"></i>',
							'class="btn btn-xs btn-danger btn-hapus" data-placement="top" title="Delete"'
						);
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
			$this->template->load('template', 'kelas/view');
		}

		function add()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// Set validation rules
				$this->form_validation->set_rules('kd_kelas', 'Kode Kelas', 'required');
				$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
				$this->form_validation->set_rules('tingkatan', 'Tingkatan', 'required');
				
				// Set custom error message
				$this->form_validation->set_message('required', '{field} tidak boleh kosong!');
				
				if ($this->form_validation->run() === FALSE) {
					$this->session->set_flashdata('error', 'Data tidak boleh kosong');
					redirect('kelas/add');
				}
				
				$kd_kelas = $this->input->post('kd_kelas', true);
				
				// Cek apakah kd_kelas sudah ada
				$cek = $this->db->get_where('tbl_kelas', ['kd_kelas' => $kd_kelas])->row();
				if ($cek) {
					$this->session->set_flashdata('error', 'Kode kelas sudah terdaftar!');
					redirect('kelas/add');
				}
				
				$this->model_kelas->save();
				$this->session->set_flashdata('success', 'Data kelas berhasil ditambahkan.');
				redirect('kelas');
			} else {
				$this->template->load('template', 'kelas/add');
			}
		}

		function edit()
		{
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$this->model_kelas->update();
				$this->session->set_flashdata('success', 'Data kelas berhasil diupdate.');
				redirect('kelas');
			} else {
				$kd_kelas 		= $this->uri->segment(3);
				$data['kelas']	= $this->db->get_where('tbl_kelas', array('kd_kelas' => $kd_kelas))->row_array();
				$this->template->load('template', 'kelas/edit', $data);
			}
		}

		function delete()
		{
			$kode_kelas = $this->uri->segment(3);
			if (!empty($kode_kelas)) {
				$this->db->where('kd_kelas', $kode_kelas);
				$this->db->delete('tbl_kelas');
				$this->session->set_flashdata('success', 'Data kelas berhasil dihapus.');
			}
			redirect('kelas');
		}

		function combobox_kelas()
		{
			$jurusan = $_GET['kd_jurusan'];
			echo "<select id='cbkelas' name='kelas' class='form-control' onChange='loadSiswa()'>";

			if (!empty($jurusan)) {
				$this->db->where('kd_jurusan', $jurusan);
			}
			$kelas = $this->db->get('tbl_kelas');
			foreach ($kelas->result() as $row) {
				echo "<option value='$row->kd_kelas' onChange='loadSiswa()'>$row->nama_kelas</option>";
			}

			echo "</select>";
		}

	}

?>
