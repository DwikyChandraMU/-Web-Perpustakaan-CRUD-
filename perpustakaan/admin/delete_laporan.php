<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol hapus
if (isset($_POST['bhapus'])) {

    //simpan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM laporan WHERE id_laporan = '$_POST[id_laporan]' ");
 
    //jika hapus berhasil
    if ($hapus) {
        echo "<script>
                alert('Hapus Data Sukses!');
                document.location='laporan.php';
             </script>";
    } else {
        echo "<script>
                alert('Hapus Data Gagal!');
                document.location='laporan.php';
             </script>";
    }
}