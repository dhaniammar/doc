    <!-- /.row -->
    <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Tambah
                </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap" id="myTable">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Nama Produk</th>
                      <th>Foto Produk</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Varian</th>
                      <th>Stok</th>
                      <th>Laba</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($produk as $prd){ ?>
                      <tr>
                      <td><?= $no; ?></td>
                      <td><?= $prd->nama_produk?></td>
                      <td><img src="<?= base_url("uploads/produk/".$prd->foto_produk) ?>" alt="" width="100px" style="border-radius:50%"></td>
                      <td><?= $prd->harga_beli ?></td>
                      <td><?= $prd->harga_jual ?></td>
                      <td><?= $prd->varian ?></td>
                      <td><?= $prd->stok ?></td>
                      <td><?= $prd->harga_jual - $prd->harga_beli ?></td>
                      <td><button class ="btn btn-primary btn-edit" data-id="<?= $prd->id?>"><i class="fas fa-pencil-alt"></i></button>
                      <button class ="btn btn-danger btn-delete" data-id="<?= $prd->id?>"><i class="fas fa-trash"></i></button></td>
                      </tr>
                    <?php $no++; } ?>
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
   

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Produk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action ="<?php echo base_url('produk/add_actions'); ?>" method="POST" enctype="multipart/form-data" id="addForm">
                <div class="modal-body">
                    <div class = "form-group">
                        <label>Nama Produk</label>
                        <input type ="text" class = "form-control" name="nama_produk" placeholder="Masukkan Nama Produk">
                    </div>
                    <div class = "form-group">
                        <label>Harga Jual</label>
                        <input type = "number" class = "form-control" name="harga_jual" placeholder="100.000">
                    </div>
                    <div class = "form-group">
                        <label>Harga Beli</label>
                        <input type = "number" class = "form-control" name="harga_beli" placeholder="100.000">
                    </div>
                    <div class = "form-group">
                        <label>Varian</label>
                        <input type = "text" class = "form-control" name="varian" placeholder="Box">
                    </div>
                    <div class = "form-group">
                        <label>Stok</label>
                        <input type = "number" class = "form-control" name="stok" placeholder="Masukkan Stok Produk">
                    </div>
                    <div class = "form-group">
                        <label>Foto Produk</label>
                        <input type = "file" class = "form-control" name="foto_produk">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id= "btnSubmit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Produk</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action ="<?php echo base_url('produk/add_actions'); ?>" method="POST" id="editForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class = "form-group">
                        <label>Nama Produk</label>
                        <input type="hidden" name="id" id="id">
                        <input type ="text" class = "form-control" name="nama_produk" id="nama_produk" namplaceholder="Masukkan Nama Produk">
                    </div>
                    <div class = "form-group">
                        <label>Harga Jual</label>
                        <input type = "number" class = "form-control" name="harga_jual" id="harga_jual" placeholder="100.000">
                    </div>
                    <div class = "form-group">
                        <label>Harga Beli</label>
                        <input type = "number" class = "form-control" name="harga_beli" id="harga_beli" placeholder="100.000">
                    </div>
                    <div class = "form-group">
                        <label>Varian</label>
                        <input type = "text" class = "form-control" name="varian" id="varian" placeholder="Box">
                    </div>
                    <div class = "form-group">
                        <label>Stok</label>
                        <input type = "number" class = "form-control" name="stok" id="stok" placeholder="Masukkan Stok Produk">
                    </div>
                    <div class="form-group">
                        <label for="">Foto Produk</label>
                        <div id="display_foto_produk">

                        </div> 
                    </div>
                    <div class = "form-group">
                        <label>Foto Produk</label>
                        <input type = "file" class = "form-control" name="foto_produk">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id= "btnEdit" class="btn btn-primary">Save</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
              <script>
        $(document).ready(function(){
            $('#btnSubmit').click(function(){
              console.log('test')
            var formData = new FormData($('#addForm')[0]);
                $.ajax({
                    url:"<?php echo base_url('produk/add_actions'); ?>",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType : false,
                    data: formData,
                    dataType: 'json',
                    success: function(result){
                      console.log(result);
                        if(result.status == true){
                          Swal.fire({
                            title: "Success",
                            text: "Your data has been successfully saved",
                            icon: "success",
                            confirmButtonText: "Done",
                            customClass: {
                              confirmButton: "btn btn-primary"
                            }
                          }).then((result)=>{
                            window.location.reload();
                          });
                        }else{
                          Swal.fire({
                            title: "Error",
                            text: result.message,
                            icon: "error",
                            confirmButtonText: "Confirm",
                            customClass: {
                              confirmButton: "btn btn-primary"
                            }
                          })
                          
                        }
                    },
                    error: function(xhr, status, error){

                    }
                });
            });

            $('.btn-edit').on("click", function(){
              var id = $(this).data('id');

              $.ajax({
                url:"<?php echo base_url('produk/edit_produk'); ?>",
                    type: "POST",
                    cache: false,
                    data: {
                      id:id
                    },
                    dataType: 'json',
                    success: function(result){
                      var data = result.data;
                      $('#nama_produk').val(data.nama_produk);
                      $('#harga_beli').val(data.harga_beli);
                      $('#harga_jual').val(data.harga_jual);
                      $('#varian').val(data.varian);
                      $('#stok').val(data.stok);
                      $('#id').val(data.id);
                      $('#display_foto_produk').html('<img src="<?= base_url('uploads/produk/') ?>'+data.foto_produk+'" width="100px" alt="">');
                      $('#modal-edit').modal('show');
                    }
              })

            })

            $('#btnEdit').click(function(){
              console.log('test')
            var formData = new FormData($('#editForm')[0]);
                $.ajax({
                    url:"<?php echo base_url('produk/update'); ?>",
                    type: "POST",
                    cache: false,
                    processData: false,
                    contentType : false,
                    data: formData,
                    dataType: 'json',
                    success: function(result){
                      console.log(result);
                        if(result.status == true){
                          Swal.fire({
                            title: "Success",
                            text: "Your data has been successfully saved",
                            icon: "success",
                            confirmButtonText: "Done",
                            customClass: {
                              confirmButton: "btn btn-primary"
                            }
                          }).then((result)=>{
                            window.location.reload();
                          });
                        }else{

                        }
                    },
                    error: function(xhr, status, error){

                    }
                });
            });

            $('.btn-delete').on("click", function(){
              var id = $(this).data('id');

              Swal.fire({
                title:"Delete",
                text:"Do you want to permanently delete these files?",
                icon:"warning",
                showCancelButton:true
              }).then((result)=>{
                if (result.isConfirmed){

                  $.ajax({
                    url:"<?php echo base_url('produk/delete'); ?>",
                    type: "POST",
                    cache: false,
                    data: {
                      id:id
                    },
                    dataType: 'json',
                    success: function(result){
                      console.log(result);
                        
                          Swal.fire({
                            title: "Success",
                            text: "Your data has been successfully saved",
                            icon: "success",
                            confirmButtonText: "Done",
                            customClass: {
                              confirmButton: "btn btn-primary"
                            }
                          }).then((result)=>{
                            window.location.reload();
                          });
                        

                        
                    }

                  })
                }
              })
              
              
            })
        });
      </script>