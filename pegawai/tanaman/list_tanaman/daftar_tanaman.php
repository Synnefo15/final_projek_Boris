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
                        <th rowspan="2">Nama Tanaman</th>
                        <th rowspan="2">Supplier</th>
                        <th colspan="3">Stok</th>
                        <th rowspan="2">Harga Jual</th>
                        <th rowspan="2">Harga Supplier</th>
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <td>Masuk</td>
                        <td>Keluar</td>
                        <td>Jumlah</td>
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
                    ORDER BY tanaman.nama");
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
                            <br>
                            <a href="?page=del_tanaman&id=<?php echo $data['id_tanaman']; ?>"
                                onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>

                    </tr>

                    <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
