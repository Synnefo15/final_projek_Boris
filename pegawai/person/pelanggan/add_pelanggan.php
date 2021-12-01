<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Pelanggan
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="FIRST_NAME" name="FIRST_NAME"
                        placeholder="Masukkan FirstName" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="LAST_NAME" name="LAST_NAME"
                        placeholder="Masukkan LastName" required>
                </div>
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
            <a href="?page=rekap_data_pelanggan" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

    if (isset ($_POST['Simpan'])){

	

    //mulai proses simpan data
        $sql_simpan = "INSERT INTO `customer`( `FIRST_NAME`, `LAST_NAME`, `PHONE_NUMBER`) VALUES (
        '".$_POST['FIRST_NAME']."',
        '".$_POST['LAST_NAME']."',
        '".$_POST['PHONE_NUMBER']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=rekap_data_pelanggan';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=person_add_pelanggan';
          }
      })</script>";
    }}
	 //selesai proses simpan data
	 ?>

<script type="text/javascript">

</script>
