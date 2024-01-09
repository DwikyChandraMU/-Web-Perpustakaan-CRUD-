<?php
// Panggil koneksi
include "../halaman awal/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas BDT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="container">
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Halaman Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="buku.php">BUKU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="anggota.php">ANGGOTA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="peminjaman.php">PEMINJAMAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">LAPORAN</a>
                    </li>
                </ul>
            </div>
            <a href="../halaman awal/index.php" class="btn btn-primary">HOME</a>
        </div>
    </nav>
</header>

<div class="container">
    <div class="mt-3">
        <h3 class="text-center">PERPUSTAKAAN MAHASISWA</h3>
    </div>

    <!-- Data Buku -->
    <div class="card mt-3">
        <div class="card-header bg-dark text-white">
            Data Buku
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="input-group mb-3 ">
                    <input type="text" name="bcari" class="form-control" placeholder="Cari Buku">
                    <button class="btn btn-primary" name="search" type="submit">Cari</button>
                    <button class="btn btn-danger" name="reset" type="submit">Reset</button>
                </div>
            </form>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                <th>No.</th>
                <th>ISBN</th>
                <th>JUDUL BUKU</th>
                <th>JENIS BUKU</th>
                <th>JUMLAH KETERSEDIAAN</th>
                <th>KODE RAK</th>
                </thead>
                <?php
                if (isset($_POST['bcari'])) {
                    $keyword = $_POST['bcari'];
                    $q = "SELECT * FROM buku WHERE isbn like '%$keyword' or judul_buku like '%$keyword' ORDER BY ISBN ASC";
                } else {
                    $q = "SELECT * FROM buku ORDER BY ISBN ASC";
                }

                $no = 1;
                $tampil = mysqli_query($koneksi, $q);
                while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['ISBN'] ?></td>
                        <td><?= $data['judul_buku'] ?></td>
                        <td><?= $data['jenis_buku'] ?></td>
                        <td><?= $data['jumlah_ketersediaan'] ?></td>
                        <td><?= $data['kode_rak'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <!-- Data Anggota -->
    <div class="card mt-3">
        <div class="card-header bg-dark text-white">
            Data Anggota
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="input-group mb-3 ">
                    <input type="text" name="acari_anggota" class="form-control" placeholder="Cari Anggota">
                    <button class="btn btn-primary" name="search_anggota" type="submit">Cari</button>
                    <button class="btn btn-danger" name="reset_anggota" type="submit">Reset</button>
                </div>
            </form>
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                <th>No.</th>
                <th>ID ANGGOTA</th>
                <th>NAMA</th>
                </thead>
                <?php
                if (isset($_POST['acari_anggota'])) {
                    $keyword_anggota = $_POST['acari_anggota'];
                    $q_anggota = "SELECT * FROM anggota WHERE id_anggota like '%$keyword_anggota' or nama like '%$keyword_anggota' ORDER BY id_anggota ASC";
                } else {
                    $q_anggota = "SELECT * FROM anggota ORDER BY id_anggota ASC";
                }

                $no_anggota = 1;
                $tampil_anggota = mysqli_query($koneksi, $q_anggota);
                while ($data_anggota = mysqli_fetch_array($tampil_anggota)) :
                    ?>
                    <tr>
                        <td><?= $no_anggota++ ?></td>
                        <td><?= $data_anggota['id_anggota'] ?></td>
                        <td><?= $data_anggota['nama'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>
    <!-- Data VIEW -->
    <div class="card mt-3">
        <div class="card-header bg-dark text-white">
            Data Peminjaman
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                <th>No.</th>
                <th>NAMA PEMINJAM</th>
                <th>JUDUL BUKU</th>
                <th>JENIS BUKU</th>
                </thead>
                <?php
                if (isset($_POST['acari_peminjam'])) {
                    $keyword_peminjam = $_POST['acari_peminjam'];
                    $q_peminjam = "SELECT * FROM peminjaman_buku WHERE id_peminjam LIKE '%$keyword_peminjam%' OR nama LIKE '%$keyword_peminjam%' ORDER BY id_peminjam ASC";
                } else {
                    $q_peminjam= "SELECT * FROM peminjaman_buku ORDER BY id_peminjam ASC";
                }
                
                // Eksekusi query anggota
                $tampil_peminjam = mysqli_query($koneksi, $q_peminjam);
                
                // Query untuk mencari buku
                $q_buku = "SELECT * FROM buku ORDER BY ISBN ASC";
                $tampil_buku = mysqli_query($koneksi, $q_buku);

                $no_peminjam = 1;

                    while ($data_peminjam = mysqli_fetch_array($tampil_peminjam)) {
                        // Mengambil data buku yang sesuai dengan data peminjam
                        $data_buku = mysqli_fetch_array($tampil_buku);
                        ?>
                        <tr>
                            <td><?= $no_peminjam++ ?></td>
                            <td><?= $data_peminjam['nama'] ?></td>
                            <td><?= $data_peminjam['judul_buku'] ?></td>
                            <td><?= $data_peminjam['jenis_buku'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>