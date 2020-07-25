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
            $c = $_GET['cari'];   
            $dataTransaksi = mysqli_query($mysqli, "SELECT *, tr.STATUS AS statusTrans FROM `transaksi` AS tr JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE tr.STATUS='terkirim'") or die("data salah: " . mysqli_error($mysqli));
        }else{
            $c = $_GET['cari'];
            $dataTransaksi = mysqli_query($mysqli, "SELECT *, tr.STATUS AS statusTrans FROM `transaksi` AS tr JOIN user AS us ON tr.ID_PENYEWA = us.ID_USER WHERE  us.NAMA like '%".$c."%' && tr.STATUS='terkirim' ") or die("data salah: " . mysqli_error($mysqli));
        }
    ?>
    <div class="container-fluid">
        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                <center><h3>  Laporan Data Transaksi Penyewaan Scaffolding PT. Kawi Sakti Megah  </h3></center>
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
                                 $status = $show['statusTrans'];
                                 $jam_pesan = $show['JAM_PEMESANAN']; 
                                 $idTrans = $show['ID_TRANSAKSI'];
                                 ?>
                                <tr>
                                <td><?php echo $show['NAMA']; ?></td>
                                            <td>Rp. <?php ?></td>
                                            <td>Rp. <?php echo number_format ($show['JAMINAN'],2,",","."); ?></td>
                                            <!-- <td><a class="btn btn-primary" href="bukti.php?ID_TRANS=<?php echo $idTrans; ?>">Lihat Bukti Transaksi</a></td> -->
                                            <td><?php echo $show['ALAMAT']; ?></td>
                                            <td><?php echo date('d-M-Y',strtotime ($show['TGL_SEWA'])); ?></td>
                                            <td><?php echo date('d-M-Y',strtotime ($show['TGL_JATUH_TEMPO'])); ?></td>
                                            <td><?php echo $status; ?></td>
                                </tr>
                            <?php }?>
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