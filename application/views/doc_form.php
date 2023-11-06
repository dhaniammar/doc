    <!-- /.row -->
    <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>

                <div class="card-tools">
                 <a href="<?php echo base_url('master_doc'); ?>" class="btn btn-warning">Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <form action="<?= base_url("master_doc/add_action"); ?>" method="POST">
                    <div class="form-group">
                            <label>Nama Dokumen</label>
                            <input type="text" name="nama_dokumen" class="form-control" placeholder="Masukkan Nama Dokumen">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
   

