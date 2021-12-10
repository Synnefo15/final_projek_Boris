<?php 
    if (isset($_GET['kode'])) {
        $sql_cek=  "SELECT monthname(tgl_pesan) as bulan FROM `penjualan_tanaman` 
        WHERE monthname(tgl_pesan) = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<?php
// $sql = $koneksi->query("SELECT monthname(tgl) as nama_bulan FROM `jurnal` WHERE monthname(tgl)='".$_GET['kode']."'");
// while ($data = $sql->fetch_assoc()) {
//     $namaBulan = $data['nama_bulan'];
// }
?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Total Transaksi Tanaman
    </h5>
    <?php
    $sql = $koneksi->query("SELECT COUNT(*) as 'total penjualan'  from penjualan_tanaman 
    WHERE monthname(tgl_pesan) = '".$_GET['kode']."'");
    while ($data= $sql->fetch_assoc()) {
  ?>
    <h2>
        <?php echo $data['total penjualan']; }?>
    </h2>

</div>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Penjualan Tanaman <br>
            Bulan :
            <?= $_GET['kode']; ?>
        </h3>

    </div>
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
                    $sql = $koneksi->query("SELECT pt.id_penjualan_tanaman ,tnm.`nama`, 
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
                                    WHERE monthname(tgl_pesan) = '".$_GET['kode']."'");
                    while ($data = $sql->fetch_assoc()) {
                    
                    ?>

                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>
                            <?php echo $data['nama']; ?>
                        </td>
                        <td>
                            <?php echo $data['supplier']; ?>
                        </td>
                        <td>
                            <?php echo $data['jumlah_pembelian']; ?>
                        </td>
                        <td>
                            <?php echo $data['Nama Cus']; ?>
                        </td>
                        <td><?= $data['tgl_pesan']; ?></td>
                        <td><?= $data['tgl_kirim']; ?></td>
                        <form action="" method="POST" enctype="multipart/form-data">

                            <!-- <td> -->

                            <!-- //&==========Tombol Modal upload========== -->
                            <!-- <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#upfoto-<?=$data['id_penjualan_tanaman']?>" title="Upload"
                                    value="<?=$data['id_penjualan_tanaman']?>">
                                    <i class="fas fa-upload"></i>
                                </button> -->

                            <!-- //& === Modal upload=====-->
                            <!-- <div class=" modal fade" id="upfoto-<?=$data['id_penjualan_tanaman']?>">
                                    <div class=" modal-dialog">
                                        <div class=" modal-content">
                                            <div class=" modal-header">
                                                <h4 class="modal-title m-2">Upload Bukti Penjualan</h4>
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </td> -->

                            <!-- //! Perbaiki -->
                            <td>
                                <!-- <input class="form-control" type="hidden" name="id_penjualan_tanaman"
                                    id="id_penjualan_tanaman" value="<?$data['id_penjualan_tanaman']?>" readonly> -->
                                <a href="?page=upload_foto&kode=<?=$_GET['kode']?>&id=<?=$data['id_penjualan_tanaman']?>"
                                    title="Upload" class="btn btn-success btn-sm">

                                    <i class="fa fa-upload"></i>
                                </a>
                                <h5 style=" font-size: 15px; color: blue;">
                                    <?php 
                                        if ($data['foto'] != null) {
                                            echo "(Foto sudah diupload)";
                                        }else{                                
                                        echo "<h5 style='font-size: 15px;color: red;'>(Foto belum diupload)</h5>" ;
                                                }
                                            ?>
                                </h5>


                            </td>
                            <!-- //!end  -->
                        </form>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
    <div class=" card-footer">
        <a href="?page=list_penjualan" title="Kembali" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<!-- /.card-body -->

<?php 
    //     if (isset($_POST['upload'])) {
    //         $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	// 		$nama = $_FILES['foto']['name'];
	// 		$x = explode('.', $nama);
	// 		$ekstensi = strtolower(end($x));
	// 		$ukuran	= $_FILES['foto']['size'];
	// 		$file_tmp = $_FILES['foto']['tmp_name'];
    //         $path = "images/".$nama;
        

    //         if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
    //             if($ukuran < 2044070){			
    //                 move_uploaded_file($file_tmp, $path);
                    
    //                 $sql_upload = "UPDATE penjualan_tanaman SET 
    //                 foto ='".$nama."' WHERE id_penjualan_tanaman = '".$data['id_penjualan_tanaman']."' ";
    //                 $query_upload=mysqli_query($koneksi, $sql_upload);
    //                 mysqli_close($koneksi);
    //                     if($query_upload){
    //                         echo "<script>
    //                         Swal.fire({title: 'FILE BERHASIL DIUPLOAD',text: '',icon: 'success',confirmButtonText: 'OK'
    //                         }).then((result) => {if (result.value){
    //                             window.location = 'index.php?page=data_penjualan&kode=$_GET[kode]';
    //                             }
    //                         })</script>";
    //                     }else{
    //                         echo "<script>
    //                         Swal.fire({
    //                             title: 'UPLOAD GAGALx',
    //                             text: '',
    //                             icon: 'error',
    //                             confirmButtonText: 'OK'
    //                         }).then((result) => {
    //                             if (result.value) {
    //                                 window.location = 'index.php?page=data_penjualan&kode=$_GET[kode]';
    //                             }
    //                         })
    //                         </script>";
    //                     }
    //             }else{
    //                 echo "<script>
    //                 Swal.fire({title: 'UKURAN OVERSIZE',text: '',icon: 'warning',confirmButtonText: 'OK'
    //                 }).then((result) => {if (result.value){
    //                     window.location = 'index.php?page=data_penjualan&kode=$_GET[kode]';
    //                     }
    //                 })</script>";
    //             }
    //         }else{
    //             echo "<script>
    //             Swal.fire({
    //                 title: 'EKSTENSI TIDAK DITERIMA',
    //                 text: '',
    //                 icon: 'error',
    //                 confirmButtonText: 'OK'
    //             }).then((result) => {
    //                 if (result.value) {
    //                     window.location = 'index.php?page=data_penjualan&kode=$_GET[kode]';
    //                 }
    //             })
    //             </script>";
    //         }
    // }
    ?>
