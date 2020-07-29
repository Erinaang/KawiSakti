<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Print PDF | Data Transaksi</title>
</head>

<body>
    <?php
    include "../connection/Connection.php";
    if ($_GET['cari'] == null) {
        $dataTransaksi = mysqli_query($mysqli, "SELECT us.NAMA, sum(ti.HARGA_ITEM * pk.JUMLAH_SET) as TOTAL, tr.DISKON ,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_JATUH_TEMPO, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.STATUS != 'selesai' GROUP BY ID_TRANSAKSI ORDER BY tr.JAM_PEMESANAN DESC") or die("data salah: " . mysqli_error($mysqli));
    } else {
        $c = $_GET['cari'];
        $dataTransaksi = mysqli_query($mysqli, "SELECT us.NAMA, sum(ti.HARGA_ITEM * pk.JUMLAH_SET) as TOTAL, tr.DISKON ,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_JATUH_TEMPO, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.STATUS!='selesai' AND  us.NAMA like '%" . $c . "%' OR DAY(tr.TGL_SEWA)='".$c."' GROUP BY tr.ID_TRANSAKSI ORDER BY tr.JAM_PEMESANAN DESC") or die("data salah: " . mysqli_error($mysqli));
    }
    ?>
    <div class="container-fluid">
        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                <center>
                    <h3> Laporan Data Transaksi Penyewaan Scaffolding PT. Kawi Sakti Megah </h3>
                </center>
                <table class="table table-condensed" style="margin-top:30px;">
                    <thead>
                        <tr>
                            <th>Nama Penyewa</th>
                            <th>Total</th>
                            <th>Jaminan</th>
                            <!-- <th>Bukti Pembayaran & KTP</th> -->
                            <th>Alamat</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($show = mysqli_fetch_array($dataTransaksi)) {
                            $status = $show['STATUS'];
                            $totalPaket = $show['TOTAL'];
                            $ongkir = $show['BIAYA'];
                            $diskon = $show['DISKON'];
                            $totalDiskon = $totalPaket - $diskon;
                            $jaminan = $totalDiskon * 30 / 100;
                            $totalPembayaran = $totalDiskon + $jaminan + $ongkir;
                        ?>
                            <tr>
                                <td><?php echo $show['NAMA']; ?></td>
                                <td>Rp. <?php echo $totalPembayaran; ?></td>
                                <td>Rp. <?php echo number_format($jaminan, 2, ",", "."); ?></td>
                                <td><?php echo $show['ALAMAT']; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($show['TGL_SEWA'])); ?></td>
                                <td><?php echo date('d-M-Y', strtotime($show['TGL_JATUH_TEMPO'])); ?></td>
                                <td><?php echo $status; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>