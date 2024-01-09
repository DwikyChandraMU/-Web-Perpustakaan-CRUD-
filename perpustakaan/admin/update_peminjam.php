<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol ubah
if (isset($_POST['bubah'])) {

    //simpan ubah data
    $ubah = mysqli_query($koneksi, "UPDATE peminjaman 
    SET ISBN = '$_POST[tISBN]', id_peminjam = '$_POST[tid_peminjam]' WHERE id_peminjam ='$_POST[id_peminjam]' ");
    
    //jika ubah berhasil
    if ($ubah) {
        echo "<script>
                alert('Ubah Data Sukses!');
                document.location='peminjaman.php';
             </script>";
    } else {
        echo "<script>
                alert('Ubah Data Gagal!');
                document.location='peminjaman.php';
             </script>";
    }
}