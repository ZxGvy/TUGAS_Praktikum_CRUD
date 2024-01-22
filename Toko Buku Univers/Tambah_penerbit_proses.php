<?php 
include "koneksi.php"; 
// menangkap data yang di kirim dari form 
$id = $_POST["id_penerbit"]; 
$nama = $_POST["nama"]; 
$alamat = $_POST["alamat"]; 
$kota = $_POST["kota"];
$telepon = $_POST["telepon"];
 
// menginput data ke database 
$sql = "INSERT INTO penerbit (id_penerbit, nama, alamat, kota, telepon) 
VALUES('$id','$nama','$alamat','$kota','$telepon')"; 
$query = mysqli_query($koneksi, $sql); 
// mengalihkan halaman kembali ke Beranda 
header("location:index.php");