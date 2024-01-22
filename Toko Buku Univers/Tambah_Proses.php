<?php 
include "koneksi.php"; 
// menangkap data yang di kirim dari form 
$id = $_POST["id_buku"]; 
$kategori = $_POST["kategori"]; 
$nama_buku = $_POST["nama_buku"]; 
$harga = $_POST["harga"];
$stok = $_POST["stok"];
$penerbit = $_POST["penerbit"]; 
 
// menginput data ke database 
$sql = "INSERT INTO buku (id_buku, kategori, nama_buku, harga, stok, penerbit) 
VALUES('$id','$kategori','$nama_buku','$harga','$stok','$penerbit')"; 
$query = mysqli_query($koneksi, $sql); 
// mengalihkan halaman kembali ke Beranda 
header("location:index.php");