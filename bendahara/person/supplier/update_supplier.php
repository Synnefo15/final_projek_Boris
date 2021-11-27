<?php

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM supplier WHERE SUPPLIER_ID='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Supplier
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type='hidden' class="form-control" name="SUPPLIER_ID" value="<?php echo $data_cek['SUPPLIER_ID']; ?>"
                readonly />

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="COMPANY_NAME" name="COMPANY_NAME"
                        value="<?php echo $data_cek['COMPANY_NAME']; ?>" />
                </div>
            </div>

            <div class="form-group row dropdown">
                <label for="" class="col-sm-2 col-form-label">Lokasi</label>

                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="LOCATION_ID"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="LOCATION_ID">
                    Pilih Lokasi
                    <option value="" disabled selected>---Pilih Lokasi---</option>
                    <?php $sql="SELECT * FROM `location`"; 
                        $kueri=mysqli_query($koneksi,$sql);
                        while ($data=mysqli_fetch_array($kueri)){
                            
                            ?>
                    <option value="<?= $data['0']; ?>"><?= $data['2']; ?></option>
                    <?php  
                        }
                        ?>
                </select>

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
            <a href="?page=rekap_data_supplier" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>



<?php

if (isset($_POST['Ubah'])) {



    $sql_ubah = "UPDATE supplier SET
        COMPANY_NAME='" . $_POST['COMPANY_NAME'] . "',
        LOCATION_ID='" . $_POST['LOCATION_ID'] . "',
        PHONE_NUMBER='" . $_POST['PHONE_NUMBER'] . "'
        WHERE SUPPLIER_ID='" . $_POST['SUPPLIER_ID'] . "'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=rekap_data_supplier';
        }
      })</script>";
    } else {
        echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=rekap_data_supplier';
        }
      })</script>";
    }
}

?>

<script type="text/javascript">

</script>
