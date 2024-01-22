<?php 
// koneksi database 
include 'koneksi.php'; 

// menangkap data yang dikirim dari form 
$id = $_POST["id_penerbit"]; 
$nama = $_POST["nama"]; 
$alamat = $_POST["alamat"]; 
$kota = $_POST["kota"];
$telepon = $_POST["telepon"];

// update data ke database 
$query = "UPDATE penerbit SET nama='$nama', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE id_penerbit='$id'";
mysqli_query($koneksi, $query);

// mengalihkan halaman kembali ke Penerbit.php 
header("location:Penerbit.php");
?>
