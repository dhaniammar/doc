    <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>

                <div class="card-tools">
                 <a href="<?php echo base_url('master_doc/add'); ?>" class="btn btn-primary">Tambah</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap" id="myTable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama Dokumen</th>
                      <th>Tanggal Dibuat</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data_dokumen as $doc){ ?>
                    <tr>
                      <td><?php echo $doc-> id; ?></td>
                      <td><?php echo $doc-> nama_dokumen; ?></td>
                      <td><?php echo $doc-> tanggal_dibuat; ?></td>
                      <td><?php echo $doc-> status; ?></td>
                      <td><a class= "btn btn-danger" href="<?= base_url('master_doc/delete/'.$doc->id) ?>">Hapus</a></td>
                    </tr>
                <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
   

