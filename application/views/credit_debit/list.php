    <!-- /.row -->
    <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
              <div class="row">

              <div class="col-lg-3 col-6  mt-3">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3><?= rupiah($debit->debit); ?></h3>
                    <p>Total Debit</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-3 col-6  mt-3">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= rupiah($credit->credit); ?></h3>
                    <p>Total Credit</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <div class="col-lg-6 col-6  mt-3">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?= rupiah($debit->debit - $credit->credit); ?></h3>
                    <p>Laba/Rugi</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>

              <!-- <div class="col-lg-6 col-6  mt-3">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      </h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div> -->

              </div>
                <table class="table table-hover text-nowrap" id="myTable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Transaksi</th>
                      <th>Debit</th>
                      <th>Credit</th>  
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($data_cd as $dcd){ ?>
                      <tr>
                      <td><?= $no; ?></td>
                      <td><?= $dcd->tgl_transaksi?></td>
                      <td><?= rupiah($dcd->debit) ?></td>
                      <td><?= rupiah($dcd->credit) ?></td>
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
              <h4 class="modal-title">Tambah customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action ="<?php echo base_url('customer/add_actions'); ?>" method="POST" id="addForm">
                <div class="modal-body">
                    <div class = "form-group">
                        <label>Nama customer</label>
                        <input type ="text" class = "form-control" name="nama_customer" placeholder="Masukkan Nama customer">
                    </div>
                    <div class = "form-group">
                        <label>Alamat customer</label>
                        <input type = "text" class = "form-control" name="alamat_customer" placeholder="Input your address">
                    </div>
                    <div class = "form-group">
                        <label>No Telp</label>
                        <input type = "text" class = "form-control" name="telp_customer" placeholder="+62812345678">
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
              <h4 class="modal-title">Edit customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action ="<?php echo base_url('customer/add_actions'); ?>" method="POST" id="editForm">
                <div class="modal-body">
                    <div class = "form-group">
                        <label>Nama customer</label>
                        <input type="hidden" name="id" id="id">
                        <input type ="text" class = "form-control" name="nama_customer" id="nama_customer" namplaceholder="Masukkan Nama customer">
                    </div>
                    <div class = "form-group">
                        <label>Alamat customer</label>
                        <input type = "text" class = "form-control" name="alamat_customer" id="alamat_customer" placeholder="Input Your Address">
                    </div>
                    <div class = "form-group">
                        <label>No Telp</label>
                        <input type = "text" class = "form-control" name="telp_customer" id="telp_customer" placeholder="+62812345678">
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
                    url:"<?php echo base_url('customer/add_actions'); ?>",
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
                url:"<?php echo base_url('customer/edit_customer'); ?>",
                    type: "POST",
                    cache: false,
                    data: {
                      id:id
                    },
                    dataType: 'json',
                    success: function(result){
                      var data = result.data;
                      $('#nama_customer').val(data.nama_customer);
                      $('#alamat_customer').val(data.alamat_customer);
                      $('#telp_customer').val(data.telp_customer);
                      console.log(data.telp_customer);
                      $('#id').val(data.id);
                      $('#modal-edit').modal('show');
                    }
              })

            })

            $('#btnEdit').click(function(){
              console.log('test')
            var formData = new FormData($('#editForm')[0]);
                $.ajax({
                    url:"<?php echo base_url('customer/update'); ?>",
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
                    url:"<?php echo base_url('customer/delete'); ?>",
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