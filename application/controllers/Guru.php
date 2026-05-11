<?php

  class Guru extends CI_Controller
  {
    
    function __construct()
    {
      parent::__construct();
      checkAksesModule();
      $this->load->library('ssp');
      $this->load->library('form_validation');
      $this->load->model('model_guru');
    }

    function data()
    {

      // nama table
      $table      = 'tbl_guru';
      // nama PK
      $primaryKey = 'id_guru';
      // list field yang mau ditampilkan
      $columns    = array(
            //tabel db(kolom di database) => dt(nama datatable di view)
            array('db' => 'id_guru', 'dt' => 'id_guru'),
            array('db' => 'nuptk', 'dt' => 'nuptk'),
            array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array(
                'db' => 'gender',
                'dt' => 'gender',
                'formatter' => function($d) {
                  //Apabila $d bernilai P maka akan menampilkan 'Pria' apabila bernilai selain P akan menampilkan 'Wanita'
                  return $d == 'P' ? 'Pria' : 'Wanita';
                }
              ),
            //untuk menampilkan aksi(edit/delete dengan parameter id guru)
            array(
                  'db' => 'id_guru',
                  'dt' => 'aksi',
                  'formatter' => function($d) {
                     return anchor('guru/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
 '.anchor(
    'guru/delete/'.$d,
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
      $this->template->load('template', 'guru/view');
    }

    function add()
    {
     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Set validation rules
        $this->form_validation->set_rules('nuptk', 'NUPTK', 'required');
        $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        // Set custom error message
        $this->form_validation->set_message('required', '{field} tidak boleh kosong!');
        
        if ($this->form_validation->run() === FALSE) {
          $this->session->set_flashdata('error', 'Data tidak boleh kosong');
          redirect('guru/add');
        }
        
        $nuptk = $this->input->post('nuptk', true);
        $username = $this->input->post('username', true);
        
        // Cek apakah NUPTK sudah ada
        $cek_nuptk = $this->db->get_where('tbl_guru', ['nuptk' => $nuptk])->row();
        if ($cek_nuptk) {
          $this->session->set_flashdata('error', 'NUPTK sudah terdaftar!');
          redirect('guru/add');
        }

        // Cek apakah Username sudah ada di tbl_user
        $cek_user = $this->db->get_where('tbl_user', ['username' => $username])->row();
        if ($cek_user) {
          $this->session->set_flashdata('error', 'Username sudah digunakan di sistem!');
          redirect('guru/add');
        }
        
        // Simpan ke tbl_guru
        $this->model_guru->save();

        // Otomatis sinkron ke tbl_user
        $user_data = array(
          'nama_lengkap'  => $this->input->post('nama_guru', TRUE),
          'username'      => $username,
          'password'      => md5($this->input->post('password', TRUE)),
          'id_level_user' => 3, // Level Guru
          'foto'          => 'fotoprofil.jpg'
        );
        $this->db->insert('tbl_user', $user_data);

        $this->session->set_flashdata('success', 'Data guru dan akun pengguna berhasil ditambahkan.');
        redirect('guru');
      } else {
        $this->template->load('template', 'guru/add');
      }
    }

    function edit()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_guru = $this->input->post('id_guru');
        $old_guru = $this->db->get_where('tbl_guru', ['id_guru' => $id_guru])->row();
        $old_username = $old_guru->username;

        // Update di tbl_guru
        $this->model_guru->update();

        // Sinkron ke tbl_user berdasarkan username lama
        $user_update = array(
          'nama_lengkap'  => $this->input->post('nama_guru', TRUE),
          'username'      => $this->input->post('username', TRUE),
          'password'      => md5($this->input->post('password', TRUE)),
        );
        $this->db->where('username', $old_username);
        $this->db->update('tbl_user', $user_update);

        $this->session->set_flashdata('success', 'Data guru dan akun pengguna berhasil diupdate.');
        redirect('guru');
      } else {
        $id_guru     = $this->uri->segment(3);
        $data['guru']  = $this->db->get_where('tbl_guru', array('id_guru' => $id_guru))->row_array();
        $this->template->load('template', 'guru/edit', $data);
      }
    }

    function delete()
    {
      $id_guru = $this->uri->segment(3);
      if ($id_guru !== NULL && $id_guru !== '') {
        // Cek apakah guru ini ada
        $guru = $this->db->get_where('tbl_guru', ['id_guru' => $id_guru])->row();
        if (!$guru) {
          $this->session->set_flashdata('error', 'Data guru tidak ditemukan.');
          redirect('guru');
        }

        // VALIDASI RELASI MANUAL
        $cek_jadwal = $this->db->get_where('tbl_jadwal', ['id_guru' => $id_guru])->num_rows();
        $cek_walikelas = $this->db->get_where('tbl_walikelas', ['id_guru' => $id_guru])->num_rows();

        if ($cek_jadwal > 0 || $cek_walikelas > 0) {
          $this->session->set_flashdata('error', 'Gagal menghapus: Guru ini masih terdaftar di Jadwal Pelajaran atau Wali Kelas.');
          redirect('guru');
        }

        // Hapus juga di tbl_user
        $this->db->where('username', $guru->username);
        $this->db->delete('tbl_user');

        // Hapus di tbl_guru
        $this->db->where('id_guru', $id_guru);
        $result = $this->db->delete('tbl_guru');

        if ($result) {
          $this->session->set_flashdata('success', 'Data guru dan akun pengguna berhasil dihapus.');
        } else {
          $this->session->set_flashdata('error', 'Gagal menghapus data guru.');
        }
      }
      redirect('guru');
    }

  }

?>
