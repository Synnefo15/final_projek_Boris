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
                    <tr>
                        <th>No</th>
                        <th>Nama Tanaman</th>
                        <th>Supplier</th>
                        <th>Stok</th>
                        <th>Harga Jual</th>
                        <th>Harga Supplier</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT tanaman.id_tanaman,tanaman.nama, supplier.COMPANY_NAME, tanaman.unit_stok, tanaman.harga_jual, tanaman.harga_supplier 
                    FROM `tanaman` 
                    INNER JOIN supplier ON supplier.SUPPLIER_ID = tanaman.id_supplier
                    ORDER BY tanaman.nama");
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
                            <?php echo $data['COMPANY_NAME']; ?>
                        </td>
                        <td>
                            <?php echo $data['unit_stok']; ?>
                        </td>
                        <td>
                            <?php echo $data['harga_jual']; ?>
                        </td>
                        <td>
                            <?php echo $data['harga_supplier']; ?>
                        </td>
                        <td>
                            <a href="?page=#&kode=<?php echo $data['id_tanaman']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=#&kode=<?php echo $data['id_tanaman']; ?>"
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
