<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data Penjualan
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">





            <div class="form-group row dropdown">
                <label class="col-sm-2 col-form-label">Tanaman</label>
                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="id_tanaman"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="id_tanaman" required>

                    <option value="" disabled selected>---Pilih Tanaman---</option>

                    <?php 
						$sql = "SELECT * FROM tanaman";
						$kueri = mysqli_query($koneksi, $sql);
						while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                    <option value="<?= $data['0']; ?>"><?= $data['1']; ?></option>
                    <?php
                    }
                ?>
                </select>
            </div>

            <div class="form-group row">


                <label class="col-sm-2 col-form-label">Jumlah Penjualan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian"
                        placeholder="Jumlah Penjualan" required>
                </div>
            </div>

            <div class="form-group row dropdown">
                <label class="col-sm-2 col-form-label">Customer</label>
                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="id_customer"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="id_customer" required>

                    <option value="" disabled selected>---Pilih Customer---</option>
                    <?php 
						$sql = ( "SELECT * 
						FROM customer");
						$kueri = mysqli_query($koneksi, $sql);
						while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                    <option value="<?= $data['0']; ?>">
                        <?= $data['1']; ?>
                        <?= ''; ?>
                        <?= $data['2']; ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Pesan</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tgl_pesan" name="tgl_pesan" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Kirim</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="tgl_kirim" name="tgl_kirim" required>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=tanaman_penjualan" title="Kembali" class="btn btn-secondary">Kembali</a>
        </div>

    </form>
</div>

<?php

    if (isset ($_POST['Simpan'])){

		$stok_keluar_awal = $data['stok_keluar'];

		$stok_keluar = $_POST['jumlah_pembelian'];		

		// *simpan data ke penjualan
        $sql_simpan = "INSERT INTO `penjualan_tanaman`(`id_tanaman`, `jumlah_pembelian`, `id_customer`, `tgl_pesan`, `tgl_kirim`) 
		VALUES  (
        '".$_POST['id_tanaman']."',
        '".$_POST['jumlah_pembelian']."',
        '".$_POST['id_customer']."',
        '".$_POST['tgl_pesan']."',
        '".$_POST['tgl_kirim']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);

		// * menambah jumlah stok keluar
		$sql_tanaman_keluar = "UPDATE tanaman SET 
		stok_keluar = '".$stok_keluar."' + '".$stok_keluar_awal."'
		WHERE id_tanaman='".$_POST['id_tanaman']."'";
		$query_TK=mysqli_query($koneksi,$sql_tanaman_keluar);
		
        mysqli_close($koneksi);

    if ($query_simpan) {
			echo "<script>
			Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=tanaman_penjualan';
				}
			})</script>";
    }else{
			echo "<script>
			Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value){
				window.location = 'index.php?page=tanaman_penjualan';
				}
			})</script>";
    }}
	 //selesai proses simpan data
	?>

<script type="text/javascript">

</script>
