# Dokumentasi Struktur DataTables di SIAKAD

## Struktur yang Benar

### 1. Controller (Siswa.php)

```php
<?php
class Siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        checkAksesModule();
        $this->load->library('ssp');
        $this->load->library('form_validation');
        $this->load->model('model_siswa');
    }

    // ✅ HANYA load view - TIDAK ada JSON output
    function index()
    {
        $this->template->load('template', 'siswa/view');
    }

    // ✅ HANYA handle data JSON
    function data()
    {
        $table      = 'tbl_siswa';
        $primaryKey = 'nim';
        $columns    = array(
            array('db' => 'foto', 'dt' => 'foto', 'formatter' => function($d) {
                return "<img width='20px' src='".base_url()."/uploads/".$d."'>";
            }),
            array('db' => 'nim', 'dt' => 'nim'),
            array('db' => 'nama', 'dt' => 'nama'),
            array('db' => 'tempat_lahir', 'dt' => 'tempat_lahir'),
            array('db' => 'tanggal_lahir', 'dt' => 'tanggal_lahir'),
            array(
                'db' => 'nim',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('siswa/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary"').'
                    '.anchor('siswa/delete/'.$d, '<i class="fa fa-times"></i>', 'class="btn btn-xs btn-danger"');
                }
            )
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );

        // Output JSON untuk DataTables
        $this->output
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
            ));
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->form_validation->set_rules('nim', 'NIM', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            // ... rules lainnya ...

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', 'Data tidak boleh kosong');
                redirect('siswa/add');
            }

            // Cek duplicate
            $nim = $this->input->post('nim', true);
            $cek = $this->db->get_where('tbl_siswa', ['nim' => $nim])->row();
            if ($cek) {
                $this->session->set_flashdata('error', 'NIM sudah terdaftar!');
                redirect('siswa/add');
            }

            $uploadFoto = $this->upload_foto_siswa();
            $this->model_siswa->save($uploadFoto);
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
            redirect('siswa');
        } else {
            $this->template->load('template', 'siswa/add');
        }
    }

    function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadFoto = $this->upload_foto_siswa();
            $this->model_siswa->update($uploadFoto);
            $this->session->set_flashdata('success', 'Data berhasil diperbarui!');
            redirect('siswa');
        } else {
            $nim = $this->uri->segment(3);
            $data['siswa'] = $this->db->get_where('tbl_siswa', ['nim' => $nim])->row_array();
            $this->template->load('template', 'siswa/edit', $data);
        }
    }

    function delete()
    {
        $nim = $this->uri->segment(3);
        if (!empty($nim)) {
            $this->db->where('nim', $nim);
            $this->db->delete('tbl_siswa');
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        }
        redirect('siswa');
    }

    function upload_foto_siswa()
    {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        $this->upload->do_upload('userfile');
        $upload = $this->upload->data();
        return $upload['file_name'];
    }
}
?>
```

---

## 2. View (siswa/view.php)

```php
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Table Siswa</h3>
                </div>
                <div class="box-body">
                    <!-- Button Add Data -->
                    <?php
                        echo anchor('siswa/add', '<button class="btn bg-navy btn-flat margin">Tambah Data</button>');
                    ?>

                    <!-- DataTables -->
                    <table id="mytable" class="table table-striped table-bordered table-hover dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>FOTO</th>
                                <th>NIM</th>
                                <th>NAMA</th>
                                <th>TEMPAT LAHIR</th>
                                <th>TANGGAL LAHIR</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DataTables CSS & JS (Local Assets) -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.css">
<script src="<?php echo base_url(); ?>assets/sweetalert2/sweetalert2.min.js"></script>

<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    var t = $('#mytable').DataTable({
        // ✅ AJAX ke /siswa/data (bukan /siswa)
        "ajax": '<?php echo site_url('siswa/data'); ?>',
        "order": [[ 2, 'asc' ]],
        "columns": [
            {
                "data": null,
                "width": "50px",
                "class": "text-center",
                "orderable": false,
            },
            {
                "data": "foto",
                "class": "text-center"
            },
            {
                "data": "nim",
                "width": "120px",
                "class": "text-center"
            },
            {
                "data": "nama"
            },
            {
                "data": "tempat_lahir",
                "width": "150px"
            },
            {
                "data": "tanggal_lahir",
                "width": "150px",
                "class": "text-center"
            },
            {
                "data": "aksi",
                "width": "80px",
                "class": "text-center"
            }
        ]
    });

    // Auto-increment nomor urut
    t.on('order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();

    // Delete dengan SweetAlert2
    $(document).on('click', '.btn-hapus', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});

// Tampilkan flashdata error/success dengan SweetAlert2
<?php
    if ($this->session->flashdata('error')): ?>
    $(document).ready(function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?php echo $this->session->flashdata('error'); ?>'
        });
    });
<?php endif; ?>

<?php
    if ($this->session->flashdata('success')): ?>
    $(document).ready(function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?php echo $this->session->flashdata('success'); ?>'
        });
    });
<?php endif; ?>
</script>
```

---

## Routes yang Diperlukan

Di `application/config/routes.php`:

```php
$route['siswa'] = 'siswa/index';           // Menampilkan halaman siswa
$route['siswa/data'] = 'siswa/data';       // AJAX DataTables
$route['siswa/add'] = 'siswa/add';
$route['siswa/edit/(:any)'] = 'siswa/edit/$1';
$route['siswa/delete/(:any)'] = 'siswa/delete/$1';
```

---

## Apa yang Sudah Diperbaiki

✅ **Constructor** - Hanya inisialisasi library dan model  
✅ **Method index()** - Hanya load view  
✅ **Method data()** - Handle JSON output untuk DataTables  
✅ **Method add/edit/delete** - Handle form validation & duplicate check  
✅ **View** - DataTables AJAX ke `/siswa/data`  
✅ **Tidak ada** - echo json, print_r, var_dump di index()

---

## Testing

1. Buka `http://domain/siswa` - akan tampil halaman dengan DataTables
2. DataTables otomatis loading data via AJAX ke `siswa/data`
3. Klik "Tambah Data" - form validation & SweetAlert2 bekerja
4. Klik Delete - konfirmasi SweetAlert2 sebelum hapus

---

## Struktur yang Sama untuk Kelas & Guru

Gunakan struktur yang sama untuk controller Kelas dan Guru:

- `index()` - load view
- `data()` - handle JSON
- `add()` - form + validation + duplicate check
- `edit()` - update dengan validation
- `delete()` - hapus data
