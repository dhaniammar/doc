<!-- /.row -->
<div class="row">
    <div class="col-12">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="card-title">
                    <?= $title; ?>
                </h3>

                <div class="card-tools">
                    <a href="<?= base_url('penjualan/form'); ?>" class="btn btn-primary">
                        Tambah
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="form-group">
                            <label for="">Customer</label>
                            <select name="id_customer" id="" class="form-control" required>
                                <option value="">--Silakan Pilih--</option>
                                <?php foreach($customers as $customer){ ?>
                                <option value="<?= $customer->id; ?>">
                                    <?= $customer->nama_customer; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Tanggal Transaksi</label>
                            <input type="date" class="form-control" name="tgl_transaksi" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tempo Pembayaran</label>
                            <select name="tempo" class="form-control" required>
                                <option value="0">0</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="60">60</option>
                            </select>
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="produk-list">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-block float-right">
                            <button type="button" id="tambah-produk" class="btn btn-primary">Tambah Produk</button>
                        </div>
                    </div>
                    <div class="col-lg-12 d-block">
                        <div class="form-group float-right mt-3">
                            <label for="">Total Penjualan</label>
                            <input type="text" id="total-penjualan" name="total_penjualan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-12 d-block">
                        <div class="form-group float-right ml-2">
                            <label for="">Sisa Tagihan</label>
                            <input type="text" id="sisa-tagihan" name="sisa_tagihan" class="form-control" readonly>
                        </div>
                        <div class="form-group float-right">
                            <label for="">Pembayaran</label>
                            <input type="text" id="total-pembayaran" name="total_pembayaran" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 d-block">
                        <button type="submit" class="btn btn-success float-right">Save</button>
                    </div>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->

<script>
    $(document).ready(function(){
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
                var produkDropDown = `<select class="nama-produk-dropdown form-control">`;
                dataProduk.forEach((produk)=>{
                    produkDropDown +=`<option value="${produk.id}">${produk.nama_produk}</option>`
                })
                produkDropDown += `</select>`;

                $("#produk-list").append(
                    `<tr>
                        <td>${produkDropDown}</td>
                        <td><input type="number" name="qty[]" min="1" value="1" class="form-control qty"></td>
                        <td><input type="number" name="harga[]" class="form-control harga" value="${dataProduk[0].harga_jual}"></td>
                        <td><input type="number" name="diskon[]" class="form-control diskon"></td>
                        <td class="total">0</td>
                        <td><button type="button" class="hapus-produk btn btn-danger btn-sm">Hapus</td>
                    </tr>`
                );
            })

        })

        $("#produk-list").on("click", ".hapus-produk", function(){
            $(this).closest("tr").remove();
        } )
    })
</script>