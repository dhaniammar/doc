<!-- /.row -->
<form action="<?= base_url("penjualan/tambah_penjualan"); ?>" method="POST">
<div class="row">
    <div class="col-12">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">
                    <?= $title; ?>
                </h3>
                <div class="card-tools">
                    <a href="<?= base_url("penjualan") ;?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="">Customer</label>
                            <p><?= $penjualan->nama_customer ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Tanggal Transaksi</label>
                            <p><?= $penjualan->tgl_transaksi?></p>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Jatuh Tempo</label>
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
</form>
<!-- /.row -->

<script>
    $(document).ready(function(){
        let totalPenjualan = 0;
        // Buat API untuk ambil data Product
        // Dari data ini ditampilin di dropdown dan tambah baris 1 baris
        function getDataProduk(callback){
            $.ajax({
                url:'<?= base_url('penjualan/get_produk')?>',
                type:'GET',
                success: function(data){
                    var res = JSON.parse(data);
                    if (res.status && res.data) {
                        callback(res.data)
                    } else {
                        console.error("Internal Server Error")
                    }
                }
            })
        }
        $('#tambah-produk').click(function(){
            getDataProduk(function(dataProduk){
                var produkDropDown = `<select class="nama-produk-dropdown form-control" name="id_produk[]">`;
                produkDropDown += `<option value="">--Silakan Pilih--</option>`
                dataProduk.forEach((produk)=>{
                    produkDropDown +=`<option value="${produk.id}" >${produk.nama_produk}</option>`
                })
                produkDropDown += `</select>`;

                $("#produk-list").append(
                    `<tr>
                        <td>${produkDropDown}</td>
                        <td><input type="number" name="qty[]" min="1" value="1" class="form-control qty"></td>
                        <td><input type="number" name="harga[]" value="-" class="form-control harga" value="${dataProduk[0].harga_jual}"></td>
                        <td><input type="number" name="diskon[]" value="0" class="form-control diskon"></td>
                        <td class="total">0</td>
                        <td><button type="button" class="hapus-produk btn btn-danger btn-sm">Hapus</td>
                    </tr>`
                );
            })

        })

        $("#produk-list").on("click", ".hapus-produk", function(){
            $(this).closest("tr").remove();
        })

        $("#produk-list").on("change",".nama-produk-dropdown", function(){
            const selectedProduk = $(this).val();
            const row = $(this).closest("tr");
            getDataProduk(function(dataProduk){
                const selectedDataProduk = dataProduk.find((produk)=> produk.id === selectedProduk);
                if(selectedDataProduk){
                    row.find(".harga").val(selectedDataProduk.harga_jual);
                    updateTotalPenjualan();
                    updateSisaTagihan();
                }
            })
        })

        $("#produk-list").on("input", ".nama-produk-dropdown, .qty, .harga, .diskon",function(){
            updateTotalPenjualan();
        })

        function updateTotalPenjualan(){
            totalPenjualan = 0;
            $("#produk-list tr").each(function(){
                const qty = parseInt($(this).find(".qty").val());
                const harga = parseFloat($(this).find(".harga").val());
                const diskon = parseFloat($(this).find(".diskon").val());

                const total = (harga * qty * (100-diskon))/100;
                $(this).find(".total").text(total);
                totalPenjualan += total
                
            })

            $("#total-penjualan").val(totalPenjualan.toFixed(0))

        }

        $("#total-pembayaran").on("input", function(){
            updateSisaTagihan();
        })
        function updateSisaTagihan(){
            const totalPembayaran = parseFloat($("#total-pembayaran").val());
            const sisaTagihan = totalPenjualan - totalPembayaran;

            if (sisaTagihan < 0){
                alert("total pembayaran melebihi total penjualan");
                $("#total-pembayaran").val("");
                $("#sisa-tagihan").val("");
            }else{
                $("#sisa-tagihan").val(sisaTagihan.toFixed(0));
            }
        }
    })
</script>