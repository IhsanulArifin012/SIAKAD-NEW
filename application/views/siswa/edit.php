<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Siswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if (isset($siswa) && !empty($siswa)): ?>
            <?php
                echo form_open_multipart('siswa/edit', 'role="form" class="form-horizontal" id="form-simpan"');
                echo form_hidden('nim', $siswa['nim']);
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">NIM</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo isset($siswa['nim']) ? $siswa['nim'] : ''; ?>" readonly="true" name="nim" class="form-control" placeholder="Masukkan NIM">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nama</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo isset($siswa['nama']) ? htmlspecialchars($siswa['nama']) : ''; ?>" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Tempat, Tgl Lahir</label>

                      <div class="col-sm-5">
                        <input type="text" value="<?php echo isset($siswa['tempat_lahir']) ? htmlspecialchars($siswa['tempat_lahir']) : ''; ?>" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                      </div>

                      <div class="col-sm-2">
                        <input type="date" value="<?php echo isset($siswa['tanggal_lahir']) ? $siswa['tanggal_lahir'] : ''; ?>" name="tanggal_lahir" class="form-control">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Gender</label>

                      <div class="col-sm-5">
                        <?php
                          echo form_dropdown('gender', array('Pilih Gender', 'L'=>'Laki-Laki', 'P'=>'Perempuan'), isset($siswa['gender']) ? $siswa['gender'] : '', "class='form-control'");
                        ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Agama</label>

                      <div class="col-sm-5">
                        <?php
                          echo cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'kd_agama', isset($siswa['kd_agama']) ? $siswa['kd_agama'] : '');
                        ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Foto</label>

                      <div class="col-sm-5">
                        <input type="file" name="userfile">
                        <?php if (isset($siswa['foto']) && !empty($siswa['foto'])): ?>
                        <img src="<?php echo base_url()."/uploads/".$siswa['foto']; ?>" width="150px">
                        <?php endif; ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kelas</label>

                      <div class="col-sm-5">
                        <?php
                          echo cmb_dinamis('kelas', 'tbl_kelas', 'nama_kelas', 'kd_kelas', isset($siswa['kd_kelas']) ? $siswa['kd_kelas'] : '');
                        ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('siswa', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
                        ?>
                      </div>
                  </div>

                </div>
                <!-- /.box-body -->
            </form>
            <?php else: ?>
            <div class="box-body">
                <div class="alert alert-danger">
                    Data siswa tidak ditemukan.
                </div>
                <?php echo anchor('siswa', 'Kembali', array('class'=>'btn btn-danger btn-flat')); ?>
            </div>
            <?php endif; ?>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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