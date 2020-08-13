<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Print PDF | Data Pengembalian</title>
</head>

<body>
    <?php
    include "../connection/Connection.php";
    if ($_GET['cari'] == null) {
        $c = $_GET['cari'];
        $transaksi = mysqli_query($mysqli, "SELECT us.NAMA, sum(ti.HARGA_ITEM * pk.JUMLAH_SET) as TOTAL, tr.DISKON ,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_JATUH_TEMPO, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.STATUS='dikirim' GROUP BY ID_TRANSAKSI") or die("data salah: " . mysqli_error($mysqli));
    } else {
        $c = $_GET['cari'];
        $transaksi = mysqli_query($mysqli, "SELECT us.NAMA, sum(ti.HARGA_ITEM * pk.JUMLAH_SET) as TOTAL, tr.DISKON ,tr.ID_TRANSAKSI, tr.TGL_SEWA, tr.TGL_JATUH_TEMPO, tr.STATUS, tr.ID_PENYEWA, tr.ALAMAT, pr.BIAYA FROM `transaksi` AS tr JOIN `transaksi_item` AS ti ON tr.ID_TRANSAKSI = ti.ID_TRANSAKSI JOIN pengiriman AS pr ON tr.ID_PENGIRIMAN = pr.ID_PENGIRIMAN JOIN `paket` AS pk ON ti.ID_PAKET = pk.ID_PAKET JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE  us.NAMA like '%" . $c . "%' OR DAY(tr.TGL_SEWA)='".$c."' AND tr.STATUS='dikirim' GROUP BY ID_TRANSAKSI") or die("data salah: " . mysqli_error($mysqli));
    }
    ?>
    <div class="container-fluid">
        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                <center>
                    <h3> Laporan Data Pengembalian Scaffolding PT. Kawi Sakti Megah </h3>
                </center>
                <table class="table table-condensed" style="margin-top:30px;">
                    <thead>
                        <tr>
                            <th>Nama Penyewa</th>
                            <th>Total</th>
                            <th>Alamat</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Pengembalian</th>
                            <!-- <th>Denda</th> -->
                            <th>Status</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($show = mysqli_fetch_array($transaksi)) {
                            $status = $show['STATUS'];
                            $idTrans = $show['ID_TRANSAKSI']; 
                            $diskon = $show['DISKON'];
                            $ongkir =  $show['BIAYA'];
                            $totalPaket = $show['TOTAL'];
                            $totalDiskon = $totalPaket - $diskon;
                            $persenDiskon = ($diskon/$totalPaket)*100;
                            $jaminan = $totalDiskon * 30 / 100;
                            $totalPembayaran = $totalDiskon + $jaminan + $ongkir;
                            ?>
                            <tr>
                                <td><?php echo $show['NAMA']; ?></td>
                                <td>Rp. <?php echo number_format ($totalPembayaran, 2, ",", ".");  ?></td>
                                <td><?php echo $show['ALAMAT']; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($show['TGL_SEWA'])); ?></td>
                                <td><?php echo date('d-M-Y', strtotime($show['TGL_JATUH_TEMPO'])); ?></td>
                                <!-- <td> <a href="form-denda.php?ID_PENYEWA=<?php echo $show['ID_PENYEWA']; ?>" data-toggle="tooltip" title="Denda" class="btn btn-danger pd-setting-ed" ><i class="fa fa-trash-square-o" aria-hidden="true"> Denda</i></a></td> -->
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