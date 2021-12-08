<?php
if (isset($_GET['kode'],$_GET['id_jurnal'])) {
    $sql_cek = "SELECT * FROM jurnal WHERE month(tgl)='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    
    $sql = $koneksi->query("SELECT monthname(tgl) as nama_bulan FROM `jurnal` WHERE monthname(tgl)='".$_GET['kode']."'");
while ($data = $sql->fetch_assoc()) {
    $namaBulan = $data['nama_bulan'];
}
    
    $sql_hapus = "DELETE FROM jurnal WHERE id_jurnal='" . $_GET['id_jurnal'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data_jurnal_lihat&kode=$namaBulan';
                    }
                })</script>";
    } else {
        echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data_jurnal_lihat&kode=$namaBulan;
                    }
                })</script>";
    }
}
