<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_guru extends CI_Controller {
    public function index() {
        $this->load->database();
        $guru = $this->db->get_where('tbl_guru', ['nama_guru' => 'default'])->row();
        if (!$guru) {
            echo "Guru with name 'default' not found.";
            return;
        }

        echo "Guru ID: " . $guru->id_guru . "\n";
        echo "Name: " . $guru->nama_guru . "\n";
        echo "NUPTK: " . $guru->nuptk . "\n";

        // Check references
        $tables = ['tbl_jadwal', 'tbl_walikelas', 'tbl_nilai', 'tbl_user'];
        foreach ($tables as $table) {
            if ($this->db->table_exists($table)) {
                $count = $this->db->get_where($table, ['id_guru' => $guru->id_guru])->num_rows();
                echo "References in $table: $count\n";
            }
        }
    }
}
