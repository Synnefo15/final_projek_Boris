<?php
$sql = $koneksi->query("SELECT COUNT(DISTINCT(nama)) as 'jumlah jenis'
FROM tanaman");
while ($data = $sql->fetch_assoc()) {
    $jumlahJenis = $data['jumlah jenis'];
}
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Daftar Tanaman
    </h5>
    <h5>Total Jenis:
        <?php
        echo $jumlahJenis;
        ?>
    </h5>


</div>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Daftar Tanaman Si Boris
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add_tanaman" class="btn btn-primary">
                    <i class="fa fa-edit m-2"></i> Tambah Data
                </a>

            </div>
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr class=" text-center">
                        <th style="width: 10px;" rowspan="2">No</th>
                        <th style="width: 50px;" rowspan="2">Nama Tanaman</th>
                        <th style="width: 70px;" rowspan="2">Supplier</th>
                        <th colspan="3">Stok</th>
                        <th style="width: 20px;" rowspan="2">Harga Jual</th>
                        <th style="width: 20px;" rowspan="2">Harga Supplier</th>
                        <th style="width: 40px;" rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <td style="width: 10px;">Masuk</td>
                        <td style="width: 10px;">Keluar</td>
                        <td style="width: 10px;">Jumlah</td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT tanaman.id_tanaman,tanaman.nama, 
                    supplier.COMPANY_NAME, 
                    tanaman.stok_masuk,
                    tanaman.stok_keluar,
                    tanaman.harga_jual, 
                    tanaman.harga_supplier,
                    tanaman.stok_masuk - tanaman.stok_keluar as 'tot stok'
                    FROM `tanaman` 
                    INNER JOIN supplier ON supplier.SUPPLIER_ID = tanaman.id_supplier
                    ORDER BY tanaman.id_supplier");
                    while ($data = $sql->fetch_assoc()) {
                        
                    ?>

                    <tr class=" text-center">
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data['nama']; ?>
                        </td>
                        <td>
                            <?php echo $data['COMPANY_NAME']; ?>
                        </td>
                        <td>
                            <?php echo $data['stok_masuk']; ?>
                        </td>
                        <td>
                            <?php echo $data['stok_keluar']; ?>
                        </td>
                        <td>
                            <?= $data['tot stok']; ?>
                        </td>
                        <td>
                            <?php echo rupiah($data['harga_jual']); ?>
                        </td>
                        <td>
                            <?php echo rupiah($data['harga_supplier']); ?>
                        </td>
                        <td class=" mb-4">
                            <a href=" ?page=update_tanaman&id=<?php echo $data['id_tanaman']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                data-target="#addstok-<?=$data['id_tanaman']?>" title="Add stok"
                                value="<?=$data['id_tanaman']?>">
                                <i class="fas fa-cubes"></i>
                            </button>




                            <a href="?page=del_tanaman&id=<?php echo $data['id_tanaman']; ?>"
                                onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        <!-- The Modal -->
                        <div class="modal fade" id="addstok-<?=$data['id_tanaman']?>">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title m-2">Tambah Stok</h4>
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <h4 class=" text-center">

                                                Isikan Stok yang masuk
                                            </h4>
                                            <h5 style="font-size: 15px;">
                                                id-nama :
                                                <?php 
                                                echo $data['id_tanaman'];
                                                echo "-";
                                                echo $data['nama'];
                                                ?>
                                            </h5>
                                            <!-- DO -->
                                            <input type="hidden" class=" form-control" name=" id_tanaman"
                                                value=" <?= $data['id_tanaman'] ?>" readonly>
                                            <input type="hidden" class=" form-control" name=" stok_masuk"
                                                value=" <?= $data['stok_masuk'] ?>" readonly>

                                            <div class=" form-group row m-2">
                                                <label for="" class="col-sm-2 col-form-label">Tanggal</label>
                                                <div class=" col-sm-8">
                                                    <input type="date" placeholder="Masukkan tanggal"
                                                        class="form-control" id="tanggal" name="tanggal">
                                                </div>
                                            </div>

                                            <div class=" form-group row m-2">
                                                <label class="col-sm-2 col-form-label">Stok: </label>
                                                <div class=" col-sm-8">
                                                    <input type="number" placeholder="Berapa stok yang masuk"
                                                        class="form-control" id="stok_masuk_add" name="stok_masuk_add"
                                                        maxlength="4">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class=" btn btn-success" name="Submit" value="Submit"
                                                title="Submit">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </tr>

                    <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<?php 
        if (isset($_POST['Submit'])) {
            
            $inputStok = $_POST['stok_masuk_add'] ;

            $sql_simpan = "INSERT INTO `tanaman_masuk`(`id_tanaman`, `jumlah`, `tanggal`) 
            VALUES ('".$_POST['id_tanaman']."',
                    '".$inputStok."',
                    '".$_POST['tanggal']."')";
            $queri_simpan = mysqli_query($koneksi,$sql_simpan);
            
            $sql_ubah = "UPDATE tanaman SET stok_masuk = '".$inputStok."' + '".$_POST['stok_masuk']."'
            WHERE id_tanaman = '".$_POST['id_tanaman']."'";

            $queri_ubah = mysqli_query($koneksi, $sql_ubah);
            mysqli_close($koneksi);

            if ($queri_ubah and $queri_simpan) {
                echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=daftar_tanaman';
                    }
                })</script>";
            }else{
                echo "<script>
            Swal.fire({
                title: 'Ubah Data Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=daftar_tanaman';
                }
            })
            </script>";
            }
        }
    
    ?>
