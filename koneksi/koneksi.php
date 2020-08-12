
 <?php

$server = "localhost";
$usernames = "kawisakt_admin";
$passwords = "erinaara123";
$database = "kawisakt_db";

$mysqli = mysqli_connect($server, $usernames, $passwords, $database);

if(mysqli_connect_error()){
    echo 'Koneksi gagal, ada masalah pada : '.mysqli_connect_error();
    exit();
    mysqli_close($mysqli);
}
?>