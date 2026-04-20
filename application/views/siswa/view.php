<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header  with-border">
              <h3 class="box-title">Data Table Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

	            <!-- button add -->
	            <?php
	                echo anchor('siswa/add', '<button class="btn bg-navy btn-flat margin">Tambah Data</button>');
	                echo '<button type="button" class="btn btn-warning btn-flat margin" data-toggle="modal" data-target="#modalImportSiswa">Import Data</button>';
	                echo anchor('siswa/naik_kelas', '<button class="btn btn-info btn-flat margin">Naik Kelas</button>');
	            ?>

              <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<script>
        $(document).ready(function() {
            var t = $('#mytable').DataTable( {
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
                        "data": "nama",
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
                    },
                ]
            } );
               
	            t.on( 'order.dt search.dt', function () {
	                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
	                    cell.innerHTML = i+1;
	                } );
	            } ).draw();

            // Konfirmasi delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                var nim = $(this).data('nim');
                Swal.fire({
                    title: 'Konfirmasi Hapus Siswa',
                    text: "Data siswa dengan NIM " + nim + " akan dihapus. Apakah Anda yakin?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
	</script>

	<?php $this->load->view('siswa/_import_excel_modal'); ?>
