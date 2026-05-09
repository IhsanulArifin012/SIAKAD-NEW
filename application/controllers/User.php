<?php

	class User extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			checkAksesModule();
			$this->load->library('ssp');
			$this->load->library('form_validation');
			$this->load->model('model_user');
		}

		function data()
		{

			// nama table
			$table      = 'view_user';
			// nama PK
			$primaryKey = 'id_user';
			// list field yang mau ditampilkan
			$columns    = array(
				//tabel db(kolom di database) => dt(nama datatable di view)
				array('db' => 'foto', 
					  'dt' => 'foto',
					  'formatter' => function($d) {
					  		return "<img width='20px' src='".base_url()."/uploads/".$d."'>";
					  }
				),
		        array('db' => 'nama_lengkap', 'dt' => 'nama_lengkap'),
		        array('db' => 'nama_level', 'dt' => 'nama_level'),
		        //untuk menampilkan aksi(edit/delete dengan parameter id user)
		        array(
		              'db' => 'id_user',
		              'dt' => 'aksi',
		              'formatter' => function($d) {
		               		return anchor('user/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
		               		'.anchor('user/delete/'.$d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger btn-hapus" data-placement="top" title="Delete"');
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
			$this->template->load('template', 'user/view');
		}

		function add()
		{
			if (isset($_POST['submit'])) {
				$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|callback_check_unique_username_level');
				$this->form_validation->set_rules('password', 'Password', 'required');
				$this->form_validation->set_rules('level_user', 'Level User', 'required');

				if ($this->form_validation->run() == FALSE) {
					$error_msg = validation_errors();
					if (strpos($error_msg, 'sudah ada') !== false) {
						$this->session->set_flashdata('error', 'Data tidak valid');
					} else {
						$this->session->set_flashdata('error', 'Data tidak boleh kosong');
					}
					$this->template->load('template', 'user/add');
				} else {
					$uploadFoto = $this->upload_foto_user();
					$this->model_user->save($uploadFoto);
					$this->session->set_flashdata('success', 'Data user berhasil disimpan.');
					redirect('user');
				}
			} else {
				$this->template->load('template', 'user/add');
			}
		}

		function edit()
		{
			if (isset($_POST['submit'])) {
				$uploadFoto = $this->upload_foto_user();
				$this->model_user->update($uploadFoto);
				$this->session->set_flashdata('success', 'Data user berhasil diubah.');
				redirect('user');
			} else {
				$id_user 		= $this->uri->segment(3);
				$data['user'] 	= $this->db->get_where('tbl_user', array('id_user' => $id_user))->row_array();
				$this->template->load('template', 'user/edit', $data);
			}
		}

		function delete()
		{
			$kode_user = $this->uri->segment(3);
			if (!empty($kode_user)) {
				$this->db->where('id_user', $kode_user);
				$this->db->delete('tbl_user');
				$this->session->set_flashdata('success', 'Data user berhasil dihapus.');
			} else {
				$this->session->set_flashdata('error', 'Data user tidak ditemukan.');
			}
			redirect('user');
		}

		function upload_foto_user()
		{
			//validasi foto yang di upload
			$config['upload_path']          = './uploads/user/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $this->load->library('upload', $config);

            //proses upload
            if ($this->upload->do_upload('userfile')) {
                $upload = $this->upload->data();
                return $upload['file_name'];
            }

            return '';
		}

		function rule()
		{
			$this->template->load('template', 'user/rule');
		}

		function module()
		{
			$level_user = $_GET['level_user'];
			echo "<table id='mytable' class='table table-striped table-bordered table-hover table-full-width dataTable'>
	                <thead>
	                    <tr>
	                        <th width='50px' class='text-center'>NO</th>
	                        <th>NAMA MODULE</th>
	                        <th>LINK</th>
	                        <th width='100px' class='text-center'> HAK AKSES</th>
	                    </tr>";

	        $menu = $this->db->get('tabel_menu');
	        $no = 1;

	        foreach ($menu->result() as $row) {
	        	echo "<tr>
							<td class='text-center'>$no</td>
							<td>$row->nama_menu</td>
							<td>$row->link</td>
							<td class='text-center'><input type='checkbox' class='module-rule' value='$row->id' "; 
				$this->check_module($level_user, $row->id);			
				echo		"></td>
	        		 </tr>";
	        	$no++;
	        }
	        echo    "</thead>
	              </table>";
		}

		function save_rule()
		{
			$level_user = $this->input->post('level_user');
			$id_modul = $this->input->post('id_modul');

			if (empty($level_user)) {
				$this->output
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode(array(
						'status' => false,
						'message' => 'Level user wajib dipilih.'
					)));
				return;
			}

			if (!is_array($id_modul)) {
				$id_modul = array();
			}
			$id_modul = array_unique(array_map('intval', $id_modul));

			$this->db->trans_start();
			$this->db->where('id_level_user', $level_user);
			$this->db->delete('tbl_user_rule');

			foreach ($id_modul as $id_menu) {
				$this->db->insert('tbl_user_rule', array(
					'id_level_user' => $level_user,
					'id_menu' => $id_menu
				));
			}
			$this->db->trans_complete();

			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode(array(
					'status' => $this->db->trans_status(),
					'message' => $this->db->trans_status()
						? 'Hak akses module berhasil disimpan.'
						: 'Hak akses module gagal disimpan.'
				)));
		}

		// function check_module digunakan untuk memanggil checked ke dalam tag html, sehingga apabila datanya ada maka akan menampilkan centang sesuai $id_menu dan $level_user
		function check_module($level_user, $id_menu)
		{
			$data 		= array(
					'id_menu' => $id_menu, 
					'id_level_user' => $level_user );
			$check 		= $this->db->get_where('tbl_user_rule', $data);

			if ($check->num_rows() > 0) {
				echo "checked ";
			}
		}

		function check_unique_username_level($username)
		{
			$level_user = $this->input->post('level_user');
			$this->db->where('username', $username);
			$this->db->where('id_level_user', $level_user);
			$query = $this->db->get('tbl_user');
			if ($query->num_rows() > 0) {
				$this->form_validation->set_message('check_unique_username_level', 'Username dengan level user ini sudah ada.');
				return FALSE;
			}
			return TRUE;
		}

	}

?>
