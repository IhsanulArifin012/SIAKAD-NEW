<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Ruangan</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php if (isset($ruangan) && !empty($ruangan)): ?>
          <?php
          echo form_open('ruangan/edit', 'role="form" class="form-horizontal" id="form-simpan"');
          echo form_hidden('kd_ruangan', $ruangan['kd_ruangan']);
          ?>

          <div class="box-body">

            <div class="form-group">
              <label class="col-sm-2 control-label">Kode Ruangan</label>

              <div class="col-sm-9">
                <input type="text" value="<?php echo isset($ruangan['kd_ruangan']) ? $ruangan['kd_ruangan'] : ''; ?>" readonly="true" name="kd_ruangan" class="form-control" placeholder="Masukkan Kode Ruangan">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Ruangan</label>

              <div class="col-sm-9">
                <input type="text" value="<?php echo isset($ruangan['nama_ruangan']) ? htmlspecialchars($ruangan['nama_ruangan']) : ''; ?>" name="nama_ruangan" class="form-control" placeholder="Masukkan Nama Ruangan">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label"></label>

              <div class="col-sm-1">
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
              </div>

              <div class="col-sm-1">
                <?php
                echo anchor('ruangan', 'Kembali', array('class' => 'btn btn-danger btn-flat'));
                ?>
              </div>
            </div>

          </div>
          <!-- /.box-body -->
          </form>
        <?php else: ?>
          <div class="box-body">
            <div class="alert alert-danger">
              Data ruangan tidak ditemukan.
            </div>
            <?php echo anchor('ruangan', 'Kembali', array('class' => 'btn btn-danger btn-flat')); ?>
          </div>
        <?php endif; ?>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>

