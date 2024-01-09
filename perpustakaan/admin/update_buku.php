<?php

//panggil koneksi db
include "../halaman awal/koneksi.php";

//uji tombol ubah
if (isset($_POST['bubah'])) {

    //simpan ubah data
    $ubah = mysqli_query($koneksi, "UPDATE buku 
    SET ISBN = '$_POST[tISBN]', judul_buku = '$_POST[tjudul_buku]', jenis_buku = '$_POST[tjenis_buku]', 
    jumlah_ketersediaan = '$_POST[tjumlah_ketersediaan]', kode_rak = '$_POST[tkode_rak]' WHERE ISBN ='$_POST[ISBN]' ");
    
    //jika ubah berhasil
    if ($ubah) {
        echo "<script>
                alert('Ubah Data Sukses!');
                document.location='buku.php';
             </script>";
    } else {
        echo "<script>
                alert('Ubah Data Gagal!');
                document.location='buku.php';
             </script>";
    }
}