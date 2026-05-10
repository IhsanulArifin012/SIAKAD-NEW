<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Tambah Detail Kurikulum</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('kurikulum/add_detail', 'class="form-horizontal" id="form-detail"');
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kurikulum</label>

                      <div class="col-sm-5">
                        <?php
                          echo cmb_dinamis('kurikulum', 'tbl_kurikulum', 'nama_kurikulum', 'id_kurikulum', $this->uri->segment(3), "readonly='true'");
                        ?>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-offset-1 col-sm-10">
                      <hr>
                      <table class="table table-bordered" id="table-mapel">
                        <thead>
                          <tr>
                            <th>Mata Pelajaran</th>
                            <th width="300">Tingkatan Kelas</th>
                            <th width="50">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="row-mapel">
                            <td>
                              <?php echo cmb_dinamis('mapel[]', 'tbl_mapel', 'nama_mapel', 'kd_mapel', null, "class='form-control select2-dynamic'"); ?>
                            </td>
                            <td>
                              <?php echo cmb_dinamis('tingkatan[]', 'tbl_tingkatan_kelas', 'nama_tingkatan', 'kd_tingkatan', null, "class='form-control'"); ?>
                            </td>
                            <td>
                              <button type="button" class="btn btn-danger btn-sm btn-remove-row" style="display:none;"><i class="fa fa-trash"></i></button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <button type="button" id="btn-add-row" class="btn btn-success btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah Baris</button>
                      <hr>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="button" id="btn-simpan" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('kurikulum/detail/'.$this->uri->segment(3), 'Kembali', array('class'=>'btn btn-danger btn-flat'));
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

<script>
$(document).ready(function() {
    // Initialize select2 for first row
    $('.select2-dynamic').select2({
        width: '100%',
        placeholder: '-- Pilih --'
    });

    // Add Row
    $('#btn-add-row').click(function() {
        let lastRow = $('.row-mapel').last();
        
        // Destroy select2 before cloning to avoid issues
        lastRow.find('.select2-dynamic').select2('destroy');
        
        let newRow = lastRow.clone();
        
        // Re-initialize select2 for last row
        lastRow.find('.select2-dynamic').select2({
            width: '100%',
            placeholder: '-- Pilih --'
        });

        // Reset values in new row
        newRow.find('select').val('');
        newRow.find('.btn-remove-row').show();
        
        // Append new row
        $('#table-mapel tbody').append(newRow);
        
        // Initialize select2 for new row
        newRow.find('.select2-dynamic').select2({
            width: '100%',
            placeholder: '-- Pilih --'
        });
    });

    // Remove Row
    $(document).on('click', '.btn-remove-row', function() {
        $(this).closest('tr').remove();
    });
});
</script>
