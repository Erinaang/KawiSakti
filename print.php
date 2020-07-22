<?php
session_start();
include "koneksi/koneksi.php"; // ambil koneksi;

$idTrans = $_GET['ID_TRANS'];
$username = $_SESSION['username'];
$totalHarga = 0;

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$date = date("Y-m-d");

$queryAdmin = mysqli_query($mysqli, "SELECT * FROM user WHERE USERNAME='$username'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryAdmin)) {
  $namaAdmin = $show['NAMA'];
}

$queryPenyewa = mysqli_query($mysqli, "SELECT * FROM transaksi AS tr JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryPenyewa)) {
  $namaPenyewa = $show['NAMA'];
}



$queryPrint = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

$queryDenda = mysqli_query($mysqli, "SELECT * FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET WHERE tr.ID_TRANSAKSI='$idTrans'") or die("data salah: " . mysqli_error($mysqli));

?>

<!DOCTYPE HTML>
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
    <br> <br>
    <div class="row">
      <div class="col-md-12">
        <p style="text-align: center "><b>STRUK PENYEWAAN</b></p><br><br>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <p> Kpd Yth : <?php echo $namaPenyewa; ?> </p>
          <b>Kawi Scaffolding</b> <br>
          Jl. Soekarno Hatta A-4 Kav.B Malang <br>
          Telp. 085105110077, 083835167826
        </div>
        <div class="col-md-4">
          <!-- <p>TEXT</p> -->
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">
          <!-- TEXTile -->
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
                <th>Frame</th>
                <th>Masa Sewa (hari) </th>
                <th>Jumlah Set x Harga (Rp.)</th>
                <th>Total Harga (Rp.)</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $index = 1;
              while ($show = mysqli_fetch_array($queryPrint)) {
                $idTrans = $show['ID_TRANSAKSI'];
                $idTransItem = $show['ID_TRANSAKSI_ITEM'];
                $idPenyewa = $show['ID_PENYEWA'];
                $ongkir = $show['BIAYA'];
                $masaSewa = $show['MASA_SEWA'];
                $hargaItem = $show['HARGA_ITEM'];
                $jumlahSet = $show['JUMLAH_SET'];
                $jamPemesanan = $show['JAM_PEMESANAN'];
                $status = $show['STATUS'];
                $proyek = $show['PROYEK'];
                $tglSewa = $show['TGL_SEWA'];
                $tglKembali = $show['TGL_KEMBALI'];

                $totalPaket = $hargaItem * $jumlahSet;
                $totalHarga = $totalHarga + $totalPaket;
                $jaminan = $totalHarga * (30 / 100);
                $totalPembayaran = $totalHarga + $ongkir + $jaminan;
              ?>
                <tr>
                  <td><?php echo $index++; ?></td>
                  <td><?php echo $show['FRAME']; ?></td>
                  <td><?php echo $masaSewa; ?> Hari</td>
                  <td><?php echo $jumlahSet; ?> Set x Rp. <?php echo $hargaItem; ?>,00</td>
                  <td>Rp. <?php echo $totalPaket; ?>,00</td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="4"> </td>
                <td><b> Sub Total : </b></td>
                <td><b> Rp. <?php echo $totalHarga; ?></b></td>
              </tr>
              <tr>
                <td colspan="4"> </td>
                <td><b> Jaminan : </b></td>
                <td><b>Rp. <?php echo $jaminan; ?> (30%) </b></td>
              </tr>
              <tr>
                <td colspan="4"> </td>
                <td><b> Ongkos Kirim : </b></td>
                <td><b>Rp. <?php echo $ongkir; ?></b></td>
              </tr>
              <tr>
                <td colspan="4"> </td>
                <td><b> Total Harga : </b></td>
                <td><b>Rp. <?php echo $totalPembayaran; ?></b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php if (isset($_GET['Selesai'])) { ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2>Denda</h2>
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Frame</th>
                  <th>Jumlah Set x Harga (Rp.)</th>
                  <th>Total Harga (Rp.)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $index = 1;
                $totalDendaAkhir = $setRusak = $biayaRusak = 0;
                while ($show = mysqli_fetch_array($queryDenda)) {
                  $setRusak = $show['SET_RUSAK'];
                  $biayaRusak = $show['BIAYA_RUSAK'];
                  $totalDenda = $biayaRusak * $setRusak;
                  $totalDendaAkhir = $totalDendaAkhir + $totalDenda;
                ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $show['FRAME']; ?></td>
                    <td><?php echo $setRusak;  ?> Set x Rp. <?php echo $biayaRusak; ?>,00</td>
                    <td>Rp. <?php echo $totalDenda; ?>,00</td>
                  </tr>
                <?php } ?>
                <tr>
                  <td colspan="2"> </td>
                  <td><b> Total : </b></td>
                  <td><b> Rp. <?php echo $totalDendaAkhir; ?></b></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php } ?>
    <br> <br>
    <!-- FOOTER -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <p>Barang tersebut akan di pakai untuk proyek (<?php echo $proyek; ?>)</p>
          <p>
            Kami telah memahami dan bersedia memenuhi syarat-syarat atau ketentuan yang telah di
            tentukan oleh PT. Kawi Sakti Megah Kota Malang. <br>
            Demikian permohonan kami atas perhatian dan kerjasamanya kami ucapkan terima kasih.
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <p>Malang, <?php echo $date; ?></p>
          <p>
            Hormat Kami,
          </p>
          <br><br><br>
          <p>(<?php echo $namaAdmin; ?>)</p>
        </div>
        <div class="col-md-6">
          <br><br><br>
          <p>
            Penerima Order,
          </p>
          <br><br><br>
          <p>(<?php echo $namaPenyewa; ?>)</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p>Permohonan di atas untuk masa sewa: <?php echo $tglSewa; ?> s/d <?php echo $tglKembali; ?></p>

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