<!-- row -->
<div class="row">
  <div class="col-lg-6 col-6  mt-3">
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?= $penjualan->total_penjualan; ?></h3>
        <p>Total Penjualan</p>
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
        <h3><?= rupiah($penjualan->omset); ?></h3>
        <p>Omset</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-6 col-6  mt-3">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= $pembelian->total_pembelian; ?></h3>
        <p>Total Pembelian</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-6 col-6  mt-3">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?= rupiah($pembelian->nominal); ?></h3>
        <p>Nominal Pembelian</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  <div class="container">
  <canvas id="myChart" class="w-5 h-5"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        <?php foreach($data_grafik as $grafik){?>
          '<?= $grafik->bulan; ?>',
        <?php } ?>
      ],
      datasets: [{
        label: 'Omset per Bulan',
        data: [
          <?php foreach($data_grafik as $grafik){?>
            '<?= $grafik->total; ?>',
          <?php } ?>
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

</div>
<!-- /row -->

