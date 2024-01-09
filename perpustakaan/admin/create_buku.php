<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol simpan
if (isset($_POST['bsimpan'])) {

    //simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO buku (ISBN, judul_buku, jenis_buku, jumlah_ketersediaan, kode_rak) 
    VALUES ('$_POST[tISBN]','$_POST[tjudul_buku]','$_POST[tjenis_buku]','$_POST[tjumlah_ketersediaan]','$_POST[tkode_rak]')");

    
    //jika simpan berhasil
    if ($simpan) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location='buku.php';
             </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location='buku.php';
             </script>";
    }
}