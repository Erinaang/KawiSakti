
 <?php

$server = "localhost";
$usernames = "root";
$passwords = "";
$database = "kawisaktimegah";

$mysqli = mysqli_connect($server, $usernames, $passwords, $database);

if(mysqli_connect_error()){
    echo 'Koneksi gagal, ada masalah pada : '.mysqli_connect_error();
    exit();
    mysqli_close($mysqli);
}
?>