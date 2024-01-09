<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol ubah
if (isset($_POST['bubah'])) {

    //simpan ubah data
    $ubah = mysqli_query($koneksi, "UPDATE anggota 
    SET id_anggota = '$_POST[tid_anggota]', nama = '$_POST[tnama]' WHERE id_anggota ='$_POST[id_anggota]' ");
    
    //jika ubah berhasil
    if ($ubah) {
        echo "<script>
                alert('Ubah Data Sukses!');
                document.location='anggota.php';
             </script>";
    } else {
        echo "<script>
                alert('Ubah Data Gagal!');
                document.location='anggota.php';
             </script>";
    }
}