<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Akun
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID Akun</label>
                <div class="col-sm-8">
                    <input type=" number" class="form-control" id="id_akun" name="id_akun"
                        placeholder="Masukkan ID Akun" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Akun</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_akun" name="nama_akun"
                        placeholder="Masukkan Nama Akun" required>
                </div>
            </div>
            <div class="form-group row dropdown">
                <label for="" class="col-sm-2 col-form-label">Keterangan</label>

                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="keterangan"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="keterangan" required>

                    <option value="" disabled selected>---Pilih Keterangan---</option>
                    <?php $sql = "SELECT * FROM akun_keterangan";
                    $kueri = mysqli_query($koneksi, $sql);
                    while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                    <option value="<?= $data['0']; ?>"><?= $data['1']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>





        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=akun_data_rekap" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['Simpan'])) {



    //mulai proses simpan data
    $sql_simpan = "INSERT INTO `akun`( id_akun,`nama_akun`, `keterangan`) VALUES (
        '" . $_POST['id_akun'] . "',    
        '" . $_POST['nama_akun'] . "',
        '" . $_POST['keterangan'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=akun_data_rekap';
          }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=akun_data_rekap';
          }
      })</script>";
    }
}
//selesai proses simpan data
?>

<script type="text/javascript">

</script>
