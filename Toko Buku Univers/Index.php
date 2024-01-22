<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOKO BUKU UNIVERS</title>
    <style>
        
        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #98D8AA;
            margin: 0;
            padding: 0;
            margin-bottom: 50px; /* Atur margin-bottom sesuai tinggi footer */
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
        fieldset {
            width: 80%;
            margin: auto;
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 50px;
            
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        #Toko_Buku_Univers {
            font-size: 40px; 
            font-family: 'Courier New', Courier, monospace; 
            color: white;
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
        </div>
    </nav>
    <fieldset>
    <center>
        <h1>Welcome To Univers</h1>
    </center>
    <form method="GET" action="index.php" style="text-align: center;">
        <label>Cari Buku :</label>
        <input type="text" name="kata_cari" value="<?php echo isset($_GET['kata_cari']) ? $_GET['kata_cari'] : ''; ?>" />
        <button type="submit">Cari</button>
    </form>
    <br>
    <table border="2">
        <thead>
            <tr>
                <th>ID Buku</th>
                <th>Kategori</th>
                <th>Nama Buku</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penerbit</th>
                <th>Aksi</th> <!-- Tambahan untuk tombol "Tambah ke Keranjang" -->
            </tr>
        </thead>
        <tbody>
            <?php
            // untuk me-include kan koneksi
            include 'koneksi.php';

            // jika kita klik cari, maka yang tampil query cari ini
            if(isset($_GET['kata_cari'])) {
                // menampung variabel kata_cari dari form pencarian
                $kata_cari = $_GET['kata_cari'];

                $query = "SELECT * FROM buku WHERE id_buku LIKE '%".$kata_cari."%' OR nama_buku LIKE '%".$kata_cari."%' ORDER BY id_buku ASC";
            } else {
                // jika tidak ada pencarian, default yang dijalankan query ini
                $query = "SELECT * FROM buku ORDER BY id_buku ASC";
            }

            $result = mysqli_query($koneksi, $query);
            if(!$result) {
                die("Query Error : ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
            }
            // kalau ini melakukan foreach atau perulangan
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id_buku']; ?></td>
                <td><?php echo $row['kategori']; ?></td>
                <td><?php echo $row['nama_buku']; ?></td>
                <td><?php echo $row['harga']; ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td><?php echo $row['penerbit']; ?></td>
                <td><button onclick="tambahKeKeranjang('<?php echo $row['nama_buku']; ?>', <?php echo $row['harga']; ?>)">Tambah ke Keranjang</button></td>
                <!-- Tambahan untuk tombol "Tambah ke Keranjang" -->
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</fieldset>

<fieldset>
    <legend align="center">Keranjang Belanja</legend>
    <table border="2">
        <thead>
            <tr>
                <th>Nama Buku</th>
                <th>Harga</th>
                <th>Aksi</th> <!-- Tambahan untuk tombol "Hapus dari Keranjang" -->
            </tr>
        </thead>
        <tbody id="keranjangTable">
            <!-- Tempat untuk menampilkan buku yang sudah ditambahkan ke dalam keranjang -->
        </tbody>
    </table>

    <!-- Form Pembayaran -->
    <form id="formPembayaran" style="margin-top: 20px; text-align: center;">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="jenisPembayaran">Jenis Pembayaran:</label>
        <select id="jenisPembayaran" name="jenisPembayaran" required>
            <option value="COD">COD</option>
            <option value="Virtual Account">Virtual Account</option>
            <option value="Digital Wallet">Digital Wallet</option>
        </select>
        <br><br>

        <button type="button" onclick="prosesPembayaran()">Bayar</button>
    </form>
</fieldset>

<script>
    let keranjang = [];

    function tambahKeKeranjang(namaBuku, harga) {
        keranjang.push({ nama: namaBuku, harga: harga });
        updateKeranjang();
    }

    function hapusDariKeranjang(index) {
        keranjang.splice(index, 1);
        updateKeranjang();
    }

    function updateKeranjang() {
        let keranjangTable = document.getElementById('keranjangTable');
        keranjangTable.innerHTML = '';

        keranjang.forEach((item, index) => {
            let row = keranjangTable.insertRow();
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);

            cell1.innerHTML = item.nama;
            cell2.innerHTML = item.harga;
            cell3.innerHTML = `<button onclick="hapusDariKeranjang(${index})">Hapus</button>`;
        });
    }
    
    function prosesPembayaran() {
        alert('Pembayaran berhasil!'); // Ubah ini dengan logika sesuai kebutuhan

        // Reset form
        document.getElementById('email').value = '';
        document.getElementById('jenisPembayaran').value = 'COD';

        // Kosongkan keranjang
        keranjang = [];
        updateKeranjang();
    }
</script>
</body>
</html>
