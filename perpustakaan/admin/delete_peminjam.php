<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol hapus
if (isset($_POST['bhapus'])) {

    //simpan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjam = '$_POST[id_peminjam]' ");
 
    //jika hapus berhasil
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='peminjaman.php';
             </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='peminjaman.php';
             </script>";
    }
}