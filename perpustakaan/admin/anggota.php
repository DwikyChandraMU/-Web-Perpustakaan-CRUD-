<?php

//panggil koneksi
include "../halaman awal/koneksi.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas BDT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </head>

  <body class="container">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Halaman Anggota</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Halaman Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buku.php">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="peminjaman.php">Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
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

    <div class="card mt-3">
      <div class="card-header bg-dark text-white">
        HALAMAN ANGGOTA
      </div>
      <div class="card-body">
      <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#ModalTambah">
        Tambahkan data
        </button>
        <table class="table table-bordered table striped table-hover">
            <thead class="table-dark">
              <th>No.</th>
              <th>ID ANGGOTA</th>
              <th>NAMA ANGGOTA</th>
              <th>AKSI</th>
          </thead>
        <?php
        if (isset($_POST['bcari'])){
          $keyword = $_POST['bcari'];
          $q = "SELECT * FROM anggota WHERE id_anggota like '%$keyword' or nama like '%$keyword' ORDER BY id_anggota ASC";
        }else{
          $q = "SELECT * FROM anggota ORDER BY id_anggota ASC";
        }
        
        $no = 1;
        $tampil = mysqli_query($koneksi, $q);
        while($data = mysqli_fetch_array($tampil)):
        
        ?>
        <tr>
              <td><?=$no++ ?></td>
              <td><?=$data['id_anggota']?></td>
              <td><?=$data['nama']?></td>
              <td>
              <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalView<?= $no ?>">Lihat</a>
              <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalUbah<?= $no ?>">Ubah</a>
              <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus<?= $no ?>">Hapus</a>
          <td>
          </tr>
          <!--Awal Hapus-->
          <div class="modal fade" id="ModalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Penghapusan Anggota</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="delete_anggota.php">

                  <input type="hidden" name="id_anggota" value="<?= $data['id_anggota']?>">

                <div class="modal-body">

                  <h5 class="text-center"> Apakah anda yakin ingin menghapus data ini? <br>
                  <span class="text-danger"><?= $data['id_anggota']?> - <?= $data['nama']?></span>
                  </h5>
                </div>

                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="bhapus">Hapus</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>

                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir Hapus-->
          <!--Awal View-->
          <div class="modal fade" id="ModalView<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Lihat data</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="anggota.php">

                  <input type="hidden" name="id_anggota" value="<?= $data['id_anggota']?>">

                <div class="modal-body">

                  <div class="form-label">ID ANGGOTA          : <?= $data['id_anggota']?></div>
                  <div class="form-label">NAMA ANGGOTA        : <?= $data['nama']?></div>
                  </h5>
                </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>

                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir View-->
          <!--Akhir ubah-->
          <div class="modal fade" id="ModalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Data Anggota</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="update_anggota.php">
                  <input type="hidden" name="id_anggota" value="<?= $data['id_anggota']?>">
                <div class="modal-body">
                  <div class="mb-3">
                  <label class="form-label">ID ANGGOTA</label>
                  <input type="text" class="form-control" name="tid_anggota" value="<?=$data ['id_anggota']?>" placeholder="ID ANGGOTA">
                  <div class="mb-3">
                  <label class="form-label">Judul Buku</label>
                  <input type="text" class="form-control" name="tnama" value="<?=$data ['nama']?>" placeholder="NAMA ANGGOTA">
                </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="bubah">ubah</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>               
                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir ubah-->
        <?php endwhile; ?>
        </table>
        <!--Awal Tambah-->
        <div class="modal fade" id="ModalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title fs-5" id="staticBackdropLabel">Form Data Anggota</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <form method="POST" action="create_anggota.php">
                <div class="modal-body">
                  
                  <div class="mb-3">
                  <label class="form-label">ID ANGGOTA</label>
                  <input type="text" class="form-control" name="tid_anggota" placeholder="ID Anggota">
                  <div class="mb-3">
                  <label class="form-label">NAMA ANGGOTA</label>
                  <input type="text" class="form-control" name="tnama" placeholder="Nama Anggota">
                </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>                 
                </div>
                </form>
              </div>
            </div>
          </div> 
          <!--Akhir tambah-->
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>