<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Toko Coding</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <div class="row">
    <div class="col-12">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">
                    <?= $title; ?>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="" class="fw-bold">Customer</label>
                            <p><?= $penjualan->nama_customer ?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <p><?= $penjualan->alamat_customer ?></p>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="fw-bold">Tanggal Transaksi</label>
                            <p><?= $penjualan->tgl_transaksi?></p>
                        </div>
                        <div class="form-group">
                            <label for="" class="fw-bold">Tanggal Jatuh Tempo</label>
                            <p><?= $penjualan->tgl_jatuh_tempo ?></p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- /.row -->

<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="card mt-1">
            <div class="card-header">
                <h3 class="card-title">
                    Product
                </h3>
                <div>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table  class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Diskon (%)</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="produk-list">
                                <?php 
                                $total_keseluruhan = 0;
                                foreach($detail_penjualan as $detail){ ?> 
                                <tr>
                                    <td><?= $detail ->nama_produk; ?></td>
                                    <td><?= $detail ->qty; ?></td>
                                    <td><?= $detail ->harga_jual; ?></td>
                                    <td><?= $detail ->diskon; ?></td>
                                    <td><?= $detail ->total; ?></td>
                                </tr>  
                                <?php 

                                $total_keseluruhan += $detail->total;
                            } ?>
                                <tr>
                                    <th colspan ="4">Total</th>
                                    <th><?= $total_keseluruhan ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
  </body>
</html>



