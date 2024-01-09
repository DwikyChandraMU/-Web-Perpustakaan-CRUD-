<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol simpan
if (isset($_POST['bsimpan'])) {

    //simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO anggota (id_anggota, nama) 
    VALUES ('$_POST[tid_anggota]','$_POST[tnama]')");

    
    //jika simpan berhasil
    if ($simpan) {
        echo "<script>
                alert('Simpan Data Sukses!');
                document.location='anggota.php';
             </script>";
    } else {
        echo "<script>
                alert('Simpan Data Gagal!');
                document.location='anggota.php';
             </script>";
    }
}