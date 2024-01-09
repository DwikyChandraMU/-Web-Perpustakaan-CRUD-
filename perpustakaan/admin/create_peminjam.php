<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol simpan
if (isset($_POST['bsimpan'])) {

    //simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO peminjaman (ISBN,tanggal, id_peminjam) 
    VALUES ('$_POST[tISBN]', now(),'$_POST[tid_peminjam]')");

    
    //jika simpan berhasil
    if ($simpan) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location='peminjaman.php';
             </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location='peminjaman.php';
             </script>";
    }
}