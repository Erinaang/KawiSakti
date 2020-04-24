<?php
include "koneksi/koneksi.php";

$index = 1;
$total = 0;
$idPenyewa = $_GET['id_penyewa'];
$tanggal = $_GET['tanggal'];
$status = $_GET['status'];
$idPengiriman = $_GET['id_pengiriman'];
$idTransaksi =$_GET['id_transaksi'];

$queryPrint = mysqli_query($mysqli, "SELECT * FROM keranjang AS kr JOIN paket AS pk ON kr.id_paket = pk.id_paket WHERE id_penyewa='$idPenyewa' AND status='$status' AND tanggal='$tanggal'") or die("data salah: " . mysqli_error($mysqli));

$queryPengiriman = mysqli_query($mysqli, "SELECT * FROM pengiriman WHERE id_pengiriman='$idPengiriman'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryPengiriman)) {
  $ongkir = $show['biaya'];
}

$queryTransaksi = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi='$idTransaksi'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryTransaksi)) {
  $totalHarga = $show['total'];
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>FAKTUR</title>
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
</head>

<body>
  <div class="container-fluid" style="border: ridge">
    <!-- TITLE -->
    <div class="row">
      <div class="col-md-12">
        <p style="text-align: center"><b>STRUK PENYEWAAN</b></p>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <p>TEXT</p>
        </div>
        <div class="col-md-4">
          <p>TEXT</p>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <br><br>
          <p>
            ALAMAT
          </p>
        </div>
        <div class="col-md-4">
          TEXT
        </div>
      </div>
    </div>
    <!-- TABLE -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <table class="table table-condensed">
            <thead>
              <tr>
                <th>No.</th>
                <th>Masa Sewa (hari) </th>
                <th>Jumlah Set x Harga (Rp.)</th>
                <th>Total Harga (Rp.)</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($show = mysqli_fetch_array($queryPrint)) {
                $total = $total + $show['total'];
                $jaminan = $total * (30 / 100);

              ?>
                <tr>
                  <td><?php echo $index++; ?></td>
                  <td><?php echo $show['masa_sewa']; ?> Hari</td>
                  <td><?php echo $show['jumlah_set']; ?> Set x Rp. <?php echo $show['harga']; ?>,00</td>
                  <td>Rp. <?php echo $show['total']; ?>,00</td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2"> </td>
                <td><b> Sub Total : </b></td>
                <td><b> Rp. <?php echo $total; ?></b></td>
              </tr>
              <tr>
                <td colspan="2"> </td>
                <td><b> Jaminan : </b></td>
                <td><b>Rp. <?php echo $jaminan; ?> (30%) </b></td>
              </tr>
              <tr>
                <td colspan="2"> </td>
                <td><b> Ongkos Kirim : </b></td>
                <td><b>Rp. <?php echo $ongkir; ?></b></td>
              </tr>
              <tr>
                <td colspan="2"> </td>
                <td><b> Total Harga : </b></td>
                <td><b>Rp. <?php echo $totalHarga; ?></b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <p>
            FOOTER
          </p>
        </div>
        <div class="col-md-4">
        </div>
      </div>
    </div>
  </div>

  <script>
    window.print();
  </script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>