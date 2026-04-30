<?php

class Kurikulum extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        checkAksesModule();
        $this->load->library('ssp');
        $this->load->model('model_kurikulum');
    }

    function data()
    {
        $table      = 'tbl_kurikulum';
        $primaryKey = 'id_kurikulum';

        $columns = array(
            array('db' => 'id_kurikulum', 'dt' => 'id_kurikulum'),
            array('db' => 'nama_kurikulum', 'dt' => 'nama_kurikulum'),
            array(
                'db' => 'is_aktif',
                'dt' => 'is_aktif',
                'formatter' => function ($d) {
                    return $d == 'Y' ? 'Aktif' : 'Tidak Aktif';
                }
            ),
            array(
                'db' => 'id_kurikulum',
                'dt' => 'aksi',
                'formatter' => function ($d) {
                    return anchor('kurikulum/detail/' . $d, '<i class="fa fa-eye"></i>', 'class="btn btn-xs bg-orange" title="View Detail"') . ' ' .
                        anchor('kurikulum/edit/' . $d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" title="Edit"') . ' ' .
                        anchor('kurikulum/delete/' . $d, '<i class="fa fa-times"></i>', 'class="btn btn-xs btn-danger btn-hapus" title="Delete"');
                }
            )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );

        echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    function index()
    {
        $this->template->load('template', 'kurikulum/view');
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_kurikulum = $this->input->post('nama_kurikulum', true);

            $cek = $this->db->get_where('tbl_kurikulum', ['nama_kurikulum' => $nama_kurikulum])->row();
            if ($cek) {
                $this->session->set_flashdata('error', 'Kurikulum sudah terdaftar!');
                redirect('kurikulum/add');
            }

            $this->model_kurikulum->save();
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
            redirect('kurikulum');
        } else {
            $this->template->load('template', 'kurikulum/add');
        }
    }

    function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model_kurikulum->update();
            $this->session->set_flashdata('success', 'Data berhasil diperbarui!');
            redirect('kurikulum');
        } else {
            $id_kurikulum = $this->uri->segment(3);
            $data['kurikulum'] = $this->db->get_where('tbl_kurikulum', array('id_kurikulum' => $id_kurikulum))->row_array();
            $this->template->load('template', 'kurikulum/edit', $data);
        }
    }

    function delete()
    {
        $id_kurikulum = $this->uri->segment(3);
        if (!empty($id_kurikulum)) {
            $this->db->where('id_kurikulum', $id_kurikulum);
            $this->db->delete('tbl_kurikulum');
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        }
        redirect('kurikulum');
    }

    function detail()
    {
        $this->template->load('template', 'kurikulum/detail');
    }

    function dataKurikulumDetail()
    {
        $kode_tingkatan = $_GET['kd_tingkatan'];
        $kurikulum = $_GET['kurikulumnya'];

        echo "<table class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>KODE MAPEL</th>
                        <th>NAMA MAPEL</th>
                        <th></th>
                    </tr>
                </thead>";

        $sql = "SELECT tkd.id_kurikulum_detail, tkd.id_kurikulum, 
                tm.kd_mapel, tm.nama_mapel
                FROM tbl_kurikulum_detail tkd
                JOIN tbl_mapel tm ON tkd.kd_mapel = tm.kd_mapel
                WHERE tkd.kd_tingkatan=$kode_tingkatan
                AND tkd.id_kurikulum=$kurikulum";

        $data = $this->db->query($sql)->result();
        $no = 1;

        foreach ($data as $row) {
            echo "<tr>
                    <td>$no</td>
                    <td>$row->kd_mapel</td>
                    <td>$row->nama_mapel</td>
                    <td>" . anchor('kurikulum/delete_detail/' . $row->id_kurikulum_detail . '/' . $row->id_kurikulum, 'Hapus') . "</td>
                  </tr>";
            $no++;
        }

        echo "</table>";
    }

    function add_detail()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model_kurikulum->save_detail();
            redirect('kurikulum/detail/' . $this->input->post('kurikulum'));
        } else {
            $this->template->load('template', 'kurikulum/add_detail');
        }
    }

    function delete_detail()
    {
        $id_detail = $this->uri->segment(3);
        $id_kurikulum = $this->uri->segment(4);

        if (!empty($id_detail)) {
            $this->db->where('id_kurikulum_detail', $id_detail);
            $this->db->delete('tbl_kurikulum_detail');
        }

        redirect('kurikulum/detail/' . $id_kurikulum);
    }
}