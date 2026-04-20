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
                <tr>
                    <td>Jurusan &amp; Tingkatan</td>
                    <td> : <?php echo "Jurusan".' '.$kelas['nama_jurusan'].' '.$kelas['nama_tingkatan']; ?> (<?php echo $kelas['nama_kelas']; ?>)</td>
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

        <button class='btn btn-success btn-xs btn-simpan-nilai mt-1' 
            data-nim='".$row->nim."'>
            Simpan
        </button>
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
    </div>
    <!-- /.row -->
</section>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).on('click', '.btn-simpan-nilai', function(){

    let nim = $(this).data('nim');
    let nilai = $("#nilai"+nim).val();

    Swal.fire({
        title: 'Simpan nilai?',
        text: 'Nilai akan disimpan',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>nilai/update_nilai',
                data: {
                    nim: nim,
                    id_jadwal: <?php echo $this->uri->segment(3); ?>,
                    nilai: nilai
                },
                success: function(){
                    Swal.fire('Berhasil', 'Nilai disimpan', 'success');
                }
            });

        }
    });

});
</script>