<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Walikelas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('walikelas/save', 'class="form-horizontal"');
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Tahun Akademik</label>

                      <div class="col-sm-9">
                        <input type="text" class="form-control" value="<?php echo get_tahun_akademik('tahun_akademik'); ?> - <?php echo get_tahun_akademik('semester'); ?>" readonly>
                        <input type="hidden" name="id_tahun_akademik" value="<?php echo $id_tahun_akademik; ?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kelas</label>

                      <div class="col-sm-5">
                        <?php if(count($kelas) > 0): ?>
                        <select name="kd_kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach($kelas as $k): ?>
                            <option value="<?php echo $k->kd_kelas; ?>"><?php echo $k->nama_kelas; ?> (<?php echo $k->kd_kelas; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                        <div class="alert alert-warning">
                            Semua kelas sudah memiliki walikelas untuk tahun akademik ini!
                        </div>
                        <?php endif; ?>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Wali Kelas (Guru)</label>

                      <div class="col-sm-5">
                        <select name="id_guru" class="form-control">
                            <option value="0">-- Belum Ditentukan --</option>
                            <?php foreach($guru as $g): ?>
                            <option value="<?php echo $g->id_guru; ?>"><?php echo $g->nama_guru; ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('walikelas', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
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