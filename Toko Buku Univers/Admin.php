<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #98D8AA;
            margin: 0;
            padding: 0;
            margin-bottom: 50px;
        }

        nav {
            background-color: #5272F2;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        nav a {
            color: white;
            text-align: center;
            text-decoration: none;
            padding: 10px;
            margin: 0 5px;
        }

        nav a:hover {
            background-color: #ddd;
            color: #072541;
        }

        #Toko_Buku_Univers {
            font-size: 40px;
            font-family:'Courier New', Courier, monospace;
            color: white;
        }

        fieldset {
            width: 80%;
            margin: auto;
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 2px solid black;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <nav>
        <div id="Toko_Buku_Univers">Toko Buku Univers</div>
        <div>
            <a href="Index.php">Home</a>
            <a href="Penerbit.php">Pengadaan</a>
            <a href="Admin.php">Admin</a>
            <a href="Tambah_form.html">Tambah Buku</a>
            <a href="Tambah_penerbit_form.html">Tambah Penerbit</a>
        </div>
    </nav>

    <fieldset>
        <center>
            <h1>Halaman Admin</h1>
        </center>
        <form method="GET" action="index.php" style="text-align: center;">
            <label>Cari Buku : </label>
            <input type="text" name="kata_cari" value="<?php if (isset($_GET['kata_cari'])) {
                echo $_GET['kata_cari'];
            } ?>" />
            <button type="submit">Cari</button>
        </form>
        <br>

        <table>
            <thead>
                <tr>
                    <th>ID Buku</th>
                    <th>Kategori</th>
                    <th>Nama Buku</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Penerbit</th>
                    <!--Tambahan untuk opsi Update & Delete-->
                    <th>OPSI</th>
                </tr>
            </thead>
            <tbody>

                <?php
                //untuk me-include kan koneksi
                include 'koneksi.php';

                //jika kita klik cari, maka yang tampil query cari ini
                if (isset($_GET['kata_cari'])) {

                    //menampung variabel kata_cari dari form pencarian
                    $kata_cari = $_GET['kata_cari'];

                    $query = "SELECT * FROM buku WHERE id_buku like '%" . $kata_cari . "%' OR 
                    nama_buku like '%" . $kata_cari . "%' ORDER BY id_buku ASC";
                } else {

                    //jika tidak ada pencarian, default yang dijalankan query ini
                    $query = "SELECT * FROM buku ORDER BY id_buku ASC";
                }

                $result = mysqli_query($koneksi, $query);
                if (!$result) {
                    die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                }
                //kalau ini melakukan foreach atau perulangan
                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tr>
                        <td><?php echo $row['id_buku']; ?></td>
                        <td><?php echo $row['kategori']; ?></td>
                        <td><?php echo $row['nama_buku']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['stok']; ?></td>
                        <td><?php echo $row['penerbit']; ?></td>

                        <td>
                            <a href="Edit_form.php?id_buku=<?php echo $row['id_buku']; ?>">EDIT</a>
                            <a href="Delete_buku.php?id_buku=<?php echo $row['id_buku']; ?>">HAPUS</a>
                        </td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </fieldset>
</body>

</html>
