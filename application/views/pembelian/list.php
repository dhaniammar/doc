    <!-- /.row -->
    <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>

                <div class="card-tools">
                <a href="<?= base_url('pembelian/form'); ?>" class="btn btn-primary">
                    Tambah
                </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap" id="myTable">
                  <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>No. Invoice</th>
                      <th>Nama Supplier</th>
                      <th>Total Harga</th>
                      <th>Jatuh Tempo</th>
                      <!-- <th>Status</th> -->
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data_pembelian as $pembelian) {?>
                      <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $pembelian->no_invoice; ?></td>
                      <td><?= $pembelian->nama_supplier; ?></td>
                      <td><?= $pembelian->total_harga; ?></td>
                      <td><?= $pembelian->tgl_jatuh_tempo; ?></td>
                      <!-- <td>Status</td> -->
                      <td><a href="<?= base_url('pembelian/detail/'.$pembelian->id); ?>" class="btn btn-warning" >Detail</a>
                      <button class ="btn btn-danger btn-delete" data-id="<?= $pembelian->id?>"><i class="fas fa-trash"></i></button></td>
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
   

    
        <script>
        $(document).ready(function(){
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
                    url:"<?php echo base_url('pembelian/delete'); ?>",
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