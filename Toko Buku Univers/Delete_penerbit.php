<?php
include 'koneksi.php';

// Memastikan bahwa parameter id_penerbit tersedia dan merupakan angka
if (isset($_GET['id_penerbit']) && is_numeric($_GET['id_penerbit'])) {
    // Mengambil ID penerbit dari parameter URL
    $id = $_GET['id_penerbit'];

    // Menyiapkan dan mengeksekusi query DELETE
    $query = "DELETE FROM penerbit WHERE id_penerbit = '$id'";
    mysqli_query($koneksi, $query);

    // Mengalihkan ke halaman Penerbit.php setelah menghapus
    header("location: Penerbit.php");
} else {
    // Menangani situasi jika parameter id_penerbit tidak tersedia atau tidak valid
    echo "Invalid request.";
}
?>
