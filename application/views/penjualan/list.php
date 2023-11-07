    <!-- /.row -->
    <div class="row">
          <div class="col-12">
            <div class="card mt-5">
              <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>

                <div class="card-tools">
                <a href="<?= base_url('penjualan/form'); ?>" class="btn btn-primary">
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
                      <th>Nama Customer</th>
                      <th>Total Harga</th>
                      <th>Jatuh Tempo</th>
                      <!-- <th>Status</th> -->
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($data_penjualan as $penjualan) {?>
                      <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $penjualan->no_invoice; ?></td>
                      <td><?= $penjualan->nama_customer; ?></td>
                      <td><?= $penjualan->total_harga; ?></td>
                      <td><?= $penjualan->tgl_jatuh_tempo; ?></td>
                      <!-- <td>Status</td> -->
                      <td><a href="<?= base_url('penjualan/detail/'.$penjualan->id); ?>" class="btn btn-warning" >Detail</a>
                      <button class ="btn btn-danger btn-delete" data-id="<?= $penjualan->id?>"><i class="fas fa-trash"></i></button></td>
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
                    url:"<?php echo base_url('penjualan/delete'); ?>",
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