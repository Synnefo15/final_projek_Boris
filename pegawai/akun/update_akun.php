<?php

    if(isset($_GET['id'])){
        $sql_cek = "SELECT * FROM akun INNER JOIN akun_keterangan ak ON akun.keterangan = ak.id_akun_keterangan  WHERE id='".$_GET['id']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class=" card card-header">
    <div class=" card-header">
        <h3 class=" card-title">
            Ubah Akun
        </h3>

    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type='hidden' class="form-control" name="id" value="<?php echo $data_cek['id']; ?>" readonly />

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">ID akun</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="id_akun" name="id_akun"
                        value="<?php echo $data_cek['id_akun']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Akun</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_akun" name="nama_akun"
                        value="<?php echo $data_cek['nama_akun']; ?>" />
                </div>
            </div>

            <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="keterangan"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="keterangan"
                style="color: white; ">

                <option value="<?=$data_cek['id_akun_keterangan']?>" selected><?= $data_cek['keterangan']; ?></option>
                <?php $sql = "SELECT * FROM akun_keterangan";
                    $kueri = mysqli_query($koneksi, $sql);
                    while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                <option value=" <?= $data['0']; ?>"><?= $data['1']; ?></option>
                <?php
                    }
                    ?>
            </select>


        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=akun_data_rekap" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

    if (isset ($_POST['Ubah'])){

	

    $sql_ubah = "UPDATE akun SET
        id_akun='".$_POST['id_akun']."',
        nama_akun='".$_POST['nama_akun']."',
        keterangan='".$_POST['keterangan']."'
        WHERE id='".$_POST['id']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
        {window.location = 'index.php?page=akun_data_rekap';
        }
        })</script>";
    }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
        {window.location = 'index.php?page=akun_data_rekap';
        }
        })</script>";
	}}
	
	?>
