<?php
/**
 * @var array $kurikulum Data kurikulum dari controller
 * @property int $kurikulum['id_kurikulum']
 * @property string $kurikulum['nama_kurikulum']
 * @property string $kurikulum['is_aktif']
 */
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Kurikulum</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
        echo form_open('kurikulum/edit', 'class="form-horizontal" id="form-kurikulum-edit"');
        echo form_hidden('id_kurikulum', $kurikulum['id_kurikulum']);
        ?>

        <div class="box-body">

          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Kurikulum</label>

            <div class="col-sm-9">
              <input type="text" name="nama_kurikulum" class="form-control" value="<?php echo set_value('nama_kurikulum', $kurikulum['nama_kurikulum']); ?>" placeholder="Masukkan Nama Kurikulum">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Is Aktif</label>

            <div class="col-sm-5">
              <?php
              echo form_dropdown('is_aktif', array('Pilih Status', 'N' => 'Tidak Aktif', 'Y' => 'Aktif'), set_value('is_aktif', $kurikulum['is_aktif']), "class='form-control'");
              ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"></label>

            <div class="col-sm-1">
              <button type="button" id="btn-simpan" class="btn btn-primary btn-flat">Simpan</button>
            </div>

            <div class="col-sm-1">
              <?php
              echo anchor('kurikulum', 'Kembali', array('class' => 'btn btn-danger btn-flat'));
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
  $('#btn-simpan').click(function() {

    Swal.fire({
      title: 'Simpan data?',
      text: 'Pastikan data sudah benar',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, simpan',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('form-kurikulum-edit').submit();
      }
    });

  });
</script>