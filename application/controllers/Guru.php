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
        
        // Cek apakah NUPTK sudah ada
        $cek = $this->db->get_where('tbl_guru', ['nuptk' => $nuptk])->row();
        if ($cek) {
          $this->session->set_flashdata('error', 'NUPTK sudah terdaftar!');
          redirect('guru/add');
        }
        
        $this->model_guru->save();
        $this->session->set_flashdata('success', 'Data guru berhasil ditambahkan.');
        redirect('guru');
      } else {
        $this->template->load('template', 'guru/add');
      }
    }

    function edit()
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->model_guru->update();
        $this->session->set_flashdata('success', 'Data guru berhasil diupdate.');
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
      if (!empty($id_guru)) {
        $this->db->where('id_guru', $id_guru);
        $this->db->delete('tbl_guru');
        $this->session->set_flashdata('success', 'Data guru berhasil dihapus.');
      }
      redirect('guru');
    }

  }

?>
