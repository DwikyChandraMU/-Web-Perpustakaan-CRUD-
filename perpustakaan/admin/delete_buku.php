<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol hapus
if (isset($_POST['bhapus'])) {

    //simpan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE ISBN = '$_POST[ISBN]' ");
 
    //jika hapus berhasil
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='buku.php';
             </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='buku.php';
             </script>";
    }
}