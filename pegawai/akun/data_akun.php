<?php
$sql = $koneksi->query("SELECT COUNT(*) AS 'total akun' FROM `akun`");
while ($data = $sql->fetch_assoc()) {
    $jumlahAkun = $data['total akun'];
}
?>



<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Daftar Akun
    </h5>
    <h5>Jumlah Total:
        <?php
        echo $jumlahAkun;
        ?>
    </h5>


</div>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Daftar AKun Si Boris
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add_akun" class="btn btn-primary">
                    <i class="fa fa-edit m-2"></i> Tambah Data
                </a>
            </div>
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Akun</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * from akun INNER JOIN akun_keterangan ak ON akun.keterangan = ak.id_akun_keterangan order by id_akun");
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data['id_akun']; ?>
                        </td>
                        <td>
                            <?php echo $data['nama_akun']; ?>
                        </td>
                        <td>
                            <?php echo $data['keterangan']; ?>

                        </td>
                        <td>
                            <a href="?page=update_akun&id=<?=$data['id']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del_akun&id=<?=$data['id']; ?>"
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
    <!-- /.card-body -->
