<?php
include 'koneksi.php';
// menyimpan data id kedalam variabel
$id = $_GET['id_buku'];
// query SQL untuk insert data
$query="DELETE FROM buku WHERE id_buku='$id'";
mysqli_query($koneksi, $query);
// mengalihkan ke halaman index.php
header("location:Admin.php");

?>