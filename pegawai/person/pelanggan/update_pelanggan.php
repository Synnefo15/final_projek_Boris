<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM customer WHERE CUST_ID='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Pelanggan
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type='hidden' class="form-control" name="CUST_ID" value="<?php echo $data_cek['CUST_ID']; ?>"
                readonly />

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">FIRST NAME</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="FIRST_NAME" name="FIRST_NAME"
                        value="<?php echo $data_cek['FIRST_NAME']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">LAST NAME</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="LAST_NAME" name="LAST_NAME"
                        value="<?php echo $data_cek['LAST_NAME']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">PHONE_NUMBER</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="PHONE_NUMBER" name="PHONE_NUMBER"
                        value="<?php echo $data_cek['PHONE_NUMBER']; ?>" />
                </div>
            </div>


        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=rekap_data_pelanggan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>



<?php

    if (isset ($_POST['Ubah'])){

	

    $sql_ubah = "UPDATE customer SET
        FIRST_NAME='".$_POST['FIRST_NAME']."',
        LAST_NAME='".$_POST['LAST_NAME']."',
        PHONE_NUMBER='".$_POST['PHONE_NUMBER']."'
        WHERE CUST_ID='".$_POST['CUST_ID']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
        {window.location = 'index.php?page=rekap_data_pelanggan';
        }
        })</script>";
    }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
        {window.location = 'index.php?page=rekap_data_pelanggan';
        }
        })</script>";
	}}
	
	?>

<script type="text/javascript">

</script>
