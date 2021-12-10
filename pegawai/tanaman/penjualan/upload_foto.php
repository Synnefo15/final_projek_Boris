<?php 
    if (isset($_GET['kode'],$_GET['id'])) {
        $sql_cek = "SELECT pt.id_penjualan_tanaman ,tnm.`nama`, 
        sup.COMPANY_NAME as supplier,
        pt.`jumlah_pembelian`, 					
        CONCAT_WS(' ',cus.FIRST_NAME,cus.LAST_NAME) AS `Nama Cus`,
        pt.tgl_pesan,
        pt.tgl_kirim,
        pt.foto    
        FROM `penjualan_tanaman` pt 
        INNER JOIN tanaman tnm ON pt.id_tanaman = tnm.id_tanaman 
        INNER JOIN customer cus ON pt.id_customer = cus.CUST_ID
        INNER JOIN supplier sup ON tnm.id_supplier = sup.SUPPLIER_ID
        WHERE pt.id_penjualan_tanaman = '".$_GET['id']."'";
        $query_cek= mysqli_query($koneksi,$sql_cek);
        $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
    }
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Detail Penjualan Tanaman <br>
            Bulan :
            <?= $_GET['kode']; ?>
            <br>
            Tanaman:
            <?= $data_cek['nama']; ?>
        </h3>

    </div>
</div>
<form action="" method="POST" enctype="multipart/form-data">

    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>

            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanaman</th>
                        <th>Supplier</th>
                        <th>Jumlah Beli</th>
                        <th>Customer</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Kirim</th>
                        <th>Upload Bukti</th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    $no = 1;
                    // $sql = $koneksi->query("SELECT pt.id_penjualan_tanaman ,tnm.`nama`, 
                    //                 sup.COMPANY_NAME as supplier,
                    //                 pt.`jumlah_pembelian`, 					
                    //                 CONCAT_WS(' ',cus.FIRST_NAME,cus.LAST_NAME) AS `Nama Cus`,
                    //                 pt.tgl_pesan,
                    //                 pt.tgl_kirim,
                    //                 pt.foto    
                    //                 FROM `penjualan_tanaman` pt 
                    //                 INNER JOIN tanaman tnm ON pt.id_tanaman = tnm.id_tanaman 
                    //                 INNER JOIN customer cus ON pt.id_customer = cus.CUST_ID
                    //                 INNER JOIN supplier sup ON tnm.id_supplier = sup.SUPPLIER_ID
                    //                 WHERE pt.id_penjualan_tanaman = '".$_GET['id']."'");
                    // while ($data = $sql->fetch_assoc()) {
                    
                    ?>

                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>
                            <?php echo $data_cek['nama']; ?>
                        </td>
                        <td>
                            <?php echo $data_cek['supplier']; ?>
                        </td>
                        <td>
                            <?php echo $data_cek['jumlah_pembelian']; ?>
                        </td>
                        <td>
                            <?php echo $data_cek['Nama Cus']; ?>
                        </td>
                        <td><?= $data_cek['tgl_pesan']; ?></td>
                        <td><?= $data_cek['tgl_kirim']; ?></td>



                        <!-- //! Perbaiki -->
                        <td>
                            <input type="hidden" name="id_penjualan_tanaman" id="id_penjualan_tanaman"
                                value="<?=$data_cek['id_penjualan_tanaman']?>" readonly>

                            <input type="file" name="foto" id="foto" class=" btn btn-warning"
                                value="<?=$data_cek['foto']?>">
                        </td>
                        <!-- //!end  -->
                    </tr>


                </tbody>
                </tfoot>
            </table>
        </div>


    </div>
    <div class=" card-footer">
        <a href="?page=data_penjualan&kode=<?=$_GET['kode']?>" title="Kembali" class="btn btn-secondary">Kembali</a>
        <input type="submit" name="upload" value="Upload Bukti" class="btn btn-info">

    </div>
</form>
<div class=" container m-3">
    <h4>Bukti Transaksi</h4>
    <img src="" alt="" width="" height="">

    <?php
                $query = "SELECT *
                from penjualan_tanaman
                WHERE id_penjualan_tanaman = '".$_GET['id']."'";
                $sql = mysqli_query($koneksi,$query);
                $data = mysqli_fetch_array($sql);
                if ($data['foto'] != null) {
                    echo $data['id_penjualan_tanaman'];
                            echo "<br>";
                            echo $data['foto'];
                            echo "<br>";
                            echo "<img src='images/".$data['foto']."' 
                            class='img-fluid' alt='Responsive image' height='800' width='400' >" ;
                }else {
                    echo "gambar belum diupload";
                }
                    // if ($row>0) {
                    //     while ($data = mysqli_fetch_array($sql)) {
                            
                    //         echo $data['id_penjualan_tanaman'];
                    //         echo "<br>";
                    //         echo $data['foto'];
                    //         echo "<img src='images/".$data['foto']."' 
                    //         class='img-fluid' alt='Responsive image'" ;
                    //     } 
                    // } else {
                    //     echo "gambar belum diupload";
                    // }
        ?>
</div>


<?php 
        if (isset($_POST['upload'])) {
            $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$nama = $_FILES['foto']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['foto']['size'];
			$file_tmp = $_FILES['foto']['tmp_name'];
            $path = "images/".$nama;
        

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 2044070){			
                    
                    $sql_upload = "UPDATE penjualan_tanaman SET 
                    foto ='".$nama."' WHERE id_penjualan_tanaman = '".$data_cek['id_penjualan_tanaman']."' ";
                    $query_upload=mysqli_query($koneksi, $sql_upload);
                    mysqli_close($koneksi);

                        if($query_upload){
                            move_uploaded_file($file_tmp, $path);

                            echo "<script>
                            Swal.fire({title: 'FILE BERHASIL DIUPLOAD',text: '',icon: 'success',confirmButtonText: 'OK'
                            }).then((result) => {if (result.value){
                                window.location = 'index.php?page=upload_foto&kode=$_GET[kode]&id=$_GET[id]';
                                }
                            })</script>";
                        }else{
                            echo "<script>
                            Swal.fire({
                                title: 'UPLOAD GAGALx',
                                text: '',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    window.location = 'index.php?page=upload_foto&kode=$_GET[kode]&id=$_GET[id]';
                                }
                            })
                            </script>";
                        }
                }else{
                    echo "<script>
                    Swal.fire({title: 'UKURAN OVERSIZE',text: '',icon: 'warning',confirmButtonText: 'OK'
                    }).then((result) => {if (result.value){
                        window.location = 'index.php?page=upload_foto&kode=$_GET[kode]&id=$_GET[id]';
    }
    })</script>";
    }
    }else{
    echo "<script>
    Swal.fire({
        title: 'EKSTENSI TIDAK DITERIMA',
        text: '',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.value) {
            window.location = 'index.php?page=upload_foto&kode=$_GET[kode]&id=$_GET[id]';
        }
    })
    </script>";
    }
    }
    ?>
