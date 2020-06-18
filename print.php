<?php
include "koneksi/koneksi.php"; // ambil koneksi;

$index = $index2 = 1;
$jaminan = $total = $totalDendaAkhir = 0;
$idPenyewa = $_GET['id_penyewa'];
$jam_pesan = $_GET['jam_pesan'];
$status = $_GET['status'];
$idPengiriman = $_GET['id_pengiriman'];
$idTransaksi = $_GET['id_transaksi'];

date_default_timezone_set('Asia/Jakarta'); //MENGUBAH TIMEZONE
$date = date("Y-m-d");

$queryPrint = mysqli_query($mysqli, "SELECT * FROM keranjang AS kr JOIN paket AS pk ON kr.id_paket = pk.id_paket WHERE id_penyewa='$idPenyewa' AND status='$status' AND jam_pemesanan='$jam_pesan'") or die("data salah: " . mysqli_error($mysqli));
$queryDenda = mysqli_query($mysqli, "SELECT * FROM keranjang AS kr JOIN paket AS pk ON kr.id_paket = pk.id_paket WHERE id_penyewa='$idPenyewa' AND status='$status' AND jam_pemesanan='$jam_pesan'") or die("data salah: " . mysqli_error($mysqli));

$queryPengiriman = mysqli_query($mysqli, "SELECT * FROM pengiriman WHERE id_pengiriman='$idPengiriman'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryPengiriman)) {
  $ongkir = $show['biaya'];
}

$queryTransaksi = mysqli_query($mysqli, "SELECT  pny.nama as penyewa, adm.nama as admin, tr.* FROM transaksi AS tr JOIN user AS pny ON tr.id_penyewa = pny.id_user JOIN user AS adm ON tr.id_admin = adm.id_user WHERE id_transaksi='$idTransaksi'") or die("data salah: " . mysqli_error($mysqli));
while ($show = mysqli_fetch_array($queryTransaksi)) {
  $totalHarga = $show['total'];
  $jaminan = $show['jaminan'];
  $tglSewa = $show['tgl_sewa'];
  $tglKembali = $show['tgl_kembali'];
  $namaPenyewa = $show['penyewa'];
  $namaAdmin = $show['admin'];
  $proyek = $show['proyek']; 
}
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
              <?php while ($show = mysqli_fetch_array($queryPrint)) {
                $total = $total + $show['total'];
                $jaminan = $total * (30 / 100);

              ?>
                <tr>
                  <td><?php echo $index++; ?></td>
                  <td><?php echo $show['frame']; ?></td>
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
                <td><b>Rp. <?php echo $total + $jaminan + $ongkir; ?></b></td>
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
                <?php while ($show = mysqli_fetch_array($queryDenda)) {
                  $setRusak = $show['set_rusak'];
                  $biayaRusak = $show['biaya_rusak'];
                  $totalDenda = $biayaRusak*$setRusak;
                  $totalDendaAkhir = $totalDendaAkhir + $totalDenda;
                ?>
                  <tr>
                    <td><?php echo $index2++; ?></td>
                    <td><?php echo $show['frame']; ?></td>
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