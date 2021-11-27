<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Supplier
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="COMPANY_NAME" name="COMPANY_NAME"
                        placeholder="Masukkan Nama" required>
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
                <label class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="PHONE_NUMBER" name="PHONE_NUMBER"
                        placeholder="Masukkan phone number" required>
                </div>
            </div>



        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=rekap_data_supplier" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

    if (isset ($_POST['Simpan'])){

	


    //mulai proses simpan data
        $sql_simpan = "INSERT INTO `supplier`( `COMPANY_NAME`, `LOCATION_ID`, `PHONE_NUMBER`) VALUES (
        '".$_POST['COMPANY_NAME']."',
        '".$_POST['LOCATION_ID']."',
        '".$_POST['PHONE_NUMBER']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=rekap_data_supplier';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=person_add_supplier';
          }
      })</script>";
    }}
	 //selesai proses simpan data
	 ?>

<script type="text/javascript">

</script>
