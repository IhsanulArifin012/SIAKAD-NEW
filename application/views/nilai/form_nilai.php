<?php
/**
 * @var array $kelas Data kelas dari controller
 * @property string $kelas['nama_jurusan']
 * @property string $kelas['nama_tingkatan']
 * @property string $kelas['nama_kelas']
 * @property string $kelas['nama_mapel']
 * @var array $siswa Data siswa dari controller
 */
?>
<section class="content">
    <div class="row">

        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header  with-border">
                <table class="table table-bordered">
                <tr>
                    <td width="200">Tahun Akademik</td>
                    <td> : <?php echo get_tahun_akademik('tahun_akademik'); ?></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td> : <?php echo get_tahun_akademik('semester'); ?></td>
                </tr>
                <!-- Jurusan disembunyikan untuk SD (tidak ada jurusan IPA/IPS) -->
                <!--
                <tr>
                    <td>Jurusan &amp; Tingkatan</td>
                    <td> : <?php echo "Jurusan".' '.$kelas['nama_jurusan'].' '.$kelas['nama_tingkatan']; ?> (<?php echo $kelas['nama_kelas']; ?>)</td>
                </tr>
                -->
                <tr>
                    <td>Tingkatan</td>
                    <td> : <?php echo $kelas['nama_tingkatan']; ?> (<?php echo $kelas['nama_kelas']; ?>)</td>
                </tr>
                <tr>
                    <td>Mata Pelajaran</td>
                    <td><?php echo $kelas['nama_mapel']?></td>
                </tr>
                </table>
            </div>
            </div>
        </div>

        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header  with-border">
              <h3 class="box-title">Daftar Siswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="text-center" width="100">NIM</th>
                        <th>NAMA SISWA</th>
                        <th class="text-center">NILAI</th>
                    </tr>
                    <?php
                        foreach ($siswa as $row) {
                            echo "<tr>
    <td class='text-center'>$row->nim</td>
    <td>$row->nama</td>
    <td width='200'>
        <input type='number' id='nilai".$row->nim."' 
        value='".check_nilai($row->nim, $this->uri->segment(3))."' 
        class='form-control'>
    </td>
</tr>";
                        }
                    ?>
                </thead>

              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-sm-12 text-right" style="margin-top: 20px;">
            <button type="button" id="btn-simpan-semua" class="btn btn-primary btn-sm">Simpan Semua Nilai</button>
            <button type="button" onclick="window.location.href='<?php echo base_url('nilai'); ?>'" class="btn btn-danger btn-sm" style="margin-left: 10px;">Kembali</button>
        </div>

    </div>
    <!-- /.row -->
</section>

<!-- SweetAlert2 Offline -->
<link rel="stylesheet" href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css'); ?>">
<script src="<?php echo base_url('assets/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- onKeyUp='updateNilai(\"$row->nim\")' -->
<!-- untuk memberikan parameter string di javascript harus diikuti dengan \" \" -->

<script type="text/javascript">
    function updateNilai(nim)
    {
        var nilai = $("#nilai"+nim).val();
        $.ajax({
            type    : 'GET',
            url     : '<?php echo base_url(); ?>nilai/update_nilai',
            data    : 'nim='+nim+'&id_jadwal='+<?php echo $this->uri->segment(3); ?>+'&nilai='+nilai,
            success : function(html) {
                
            }
        })
    }
</script>

<script>
$(document).on('click', '#btn-simpan-semua', function(){

    Swal.fire({
        title: 'Simpan semua nilai?',
        text: 'Semua nilai siswa akan disimpan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan semua',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            // Array siswa dari PHP
            let siswa = <?php echo json_encode($siswa); ?>;
            let id_jadwal = <?php echo $this->uri->segment(3); ?>;
            let total = siswa.length;
            let successCount = 0;

            siswa.forEach(function(row) {
                let nim = row.nim;
                let nilai = $("#nilai" + nim).val();

                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url(); ?>nilai/update_nilai',
                    data: {
                        nim: nim,
                        id_jadwal: id_jadwal,
                        nilai: nilai
                    },
                    success: function(response) {
                        successCount++;
                        if (successCount === total) {
                            Swal.fire('Berhasil', 'Semua nilai telah disimpan', 'success').then(() => {
                                window.location.href = '<?php echo base_url("nilai"); ?>';
                            });
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan nilai', 'error');
                    }
                });
            });

        }
    });

});
</script>