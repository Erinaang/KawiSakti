<?php
session_start();
$status = $_SESSION['status'];

session_destroy();

if ($status == "admin") {
	header("Location: login.php");
} else {
	header("Location: ../index.php");
}

echo "<script>alert('Berhasil Logout.');document.location.href='index.php'</script>";
?>