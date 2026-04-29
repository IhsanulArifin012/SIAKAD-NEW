<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Tingkatan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
        echo form_open('tingkatan/edit', 'role="form" class="form-horizontal" id="form-simpan"');
        echo form_hidden('kd_mapel', $tingkatan['kd_tingkatan']);
        ?>

        <div class="box-body">

          <div class="form-group">
            <label class="col-sm-2 control-label">Kode Tingkatan</label>

            <div class="col-sm-9">
              <input type="text" value="<?php echo $tingkatan['kd_tingkatan']; ?>" readonly="true" name="kd_tingkatan" class="form-control" placeholder="Masukkan Kode Tingkat Kelas">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Tingkatan Kelas</label>

            <div class="col-sm-9">
              <input type="text" value="<?php echo $tingkatan['nama_tingkatan']; ?>" name="nama_tingkatan" class="form-control" placeholder="Masukkan Nama Tingkatan Kelas">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"></label>

            <div class="col-sm-1">
              <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
            </div>

            <div class="col-sm-1">
              <?php
              echo anchor('tingkatan', 'Kembali', array('class' => 'btn btn-danger btn-flat'));
              ?>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

<!-- SweetAlert2 Offline -->
<link rel="stylesheet" href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css'); ?>">
<script src="<?php echo base_url('assets/sweetalert2/sweetalert2.min.js'); ?>"></script>
<?php if ($this->session->flashdata('error')): ?>
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Gagal',
      text: '<?php echo $this->session->flashdata('error'); ?>'
    });
  </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success')): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Berhasil',
      text: '<?php echo $this->session->flashdata('success'); ?>'
    });
  </script>
<?php endif; ?>

<script>
  $(document).on('submit', '#form-simpan', function(e) {
    e.preventDefault();

    let form = this;

    Swal.fire({
      title: 'Simpan data?',
      text: 'Pastikan data sudah benar',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, simpan',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {

        HTMLFormElement.prototype.submit.call(form);
      }
    });
  });
</script>