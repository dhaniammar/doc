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
                      <th>No</th>
                      <th>Nama supplier</th>
                      <th>Alamat supplier</th>
                      <th>Telp supplier</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($supplier as $spl){ ?>
                      <tr>
                      <td><?= $no; ?></td>
                      <td><?= $spl->nama_supplier?></td>
                      <td><?= $spl->alamat_supplier ?></td>
                      <td><?= $spl->telp_supplier ?></td>
                      <td><button class ="btn btn-primary btn-edit" data-id="<?= $spl->id?>"><i class="fas fa-pencil-alt"></i></button>
                      <button class ="btn btn-danger btn-delete" data-id="<?= $spl->id?>"><i class="fas fa-trash"></i></button></td>
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
              <h4 class="modal-title">Tambah supplier</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action ="<?php echo base_url('supplier/add_actions'); ?>" method="POST" id="addForm">
                <div class="modal-body">
                    <div class = "form-group">
                        <label>Nama supplier</label>
                        <input type ="text" class = "form-control" name="nama_supplier" placeholder="Masukkan Nama supplier">
                    </div>
                    <div class = "form-group">
                        <label>Alamat supplier</label>
                        <input type = "text" class = "form-control" name="alamat_supplier" placeholder="Input your address">
                    </div>
                    <div class = "form-group">
                        <label>No Telp</label>
                        <input type = "number" class = "form-control" name="telp_supplier" placeholder="+62812345678">
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
              <h4 class="modal-title">Edit supplier</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action ="<?php echo base_url('supplier/add_actions'); ?>" method="POST" id="editForm">
                <div class="modal-body">
                    <div class = "form-group">
                        <label>Nama supplier</label>
                        <input type="hidden" name="id" id="id">
                        <input type ="text" class = "form-control" name="nama_supplier" id="nama_supplier" namplaceholder="Masukkan Nama supplier">
                    </div>
                    <div class = "form-group">
                        <label>Alamat supplier</label>
                        <input type = "text" class = "form-control" name="alamat_supplier" id="alamat_supplier" placeholder="Input Your Address">
                    </div>
                    <div class = "form-group">
                        <label>No Telp</label>
                        <input type = "number" class = "form-control" name="telp_supplier" id="telp_supplier" placeholder="+62812345678">
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
                    url:"<?php echo base_url('supplier/add_actions'); ?>",
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

            $('.btn-edit').on("click", function(){
              var id = $(this).data('id');

              $.ajax({
                url:"<?php echo base_url('supplier/edit_supplier'); ?>",
                    type: "POST",
                    cache: false,
                    data: {
                      id:id
                    },
                    dataType: 'json',
                    success: function(result){
                      var data = result.data;
                      $('#nama_supplier').val(data.nama_supplier);
                      $('#alamat_supplier').val(data.alamat_supplier);
                      $('#telp_supplier').val(data.telp_supplier);
                      $('#id').val(data.id);
                      $('#modal-edit').modal('show');
                    }
              })

            })

            $('#btnEdit').click(function(){
              console.log('test')
            var formData = new FormData($('#editForm')[0]);
                $.ajax({
                    url:"<?php echo base_url('supplier/update'); ?>",
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
                    url:"<?php echo base_url('supplier/delete'); ?>",
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