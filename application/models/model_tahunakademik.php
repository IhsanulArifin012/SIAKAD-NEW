<?php
 
	class Model_tahunakademik extends CI_Model
	{
		
		public $table = "tbl_tahun_akademik";

		function save()
		{
		 	$data = array(
		 		//tabel di database => name di form
		 		'tahun_akademik'	=> $this->input->post('tahun_akademik', TRUE),
		 		'is_aktif'			=> $this->input->post('is_aktif', TRUE)
		 		//'semester_aktif'	= $this->input->post('semester_aktif', TRUE)
		 	);
		 	$this->db->insert($this->table, $data);
		}

		function update()
		{
			$data = array(
		 		//tabel di database => name di form
		 		'tahun_akademik'	=> $this->input->post('tahun_akademik', TRUE),
		 		'is_aktif'			=> $this->input->post('is_aktif', TRUE),
		 	);

			if ($this->input->post('semester', TRUE) !== NULL) {
		 		$data['semester'] = $this->input->post('semester', TRUE);
			}

		 	$id_tahunakademik = $this->input->post('id_tahunakademik');

			if ($data['is_aktif'] == 'Y') {
				$this->db->where('is_aktif', 'Y');
				$this->db->update($this->table, array('is_aktif' => 'N'));
			}

		 	$this->db->where('id_tahun_akademik', $id_tahunakademik);
		 	$this->db->update($this->table, $data);
		}

	}

?>
