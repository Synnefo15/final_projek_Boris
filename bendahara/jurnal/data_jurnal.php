<?php
$sql = $koneksi->query("SELECT SUM(debit) as 'total debit' FROM `jurnal`");
while ($data = $sql->fetch_assoc()) {
    $jumlahDebit = $data['total debit'];
}
?>

<?php
$sql = $koneksi->query("SELECT SUM(kredit) as 'total kredit' FROM `jurnal`");
while ($data = $sql->fetch_assoc()) {
    $jumlahKredit = $data['total kredit'];
}
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Total Debit
    </h5>
    <h5>Jumlah Total:
        <?php
        echo rupiah($jumlahDebit)
        ?>
    </h5>
    <h5>
        <i class="icon fas fa-info"></i> Total Kredit
    </h5>
    <h5>Jumlah Total:
        <?php
        echo rupiah($jumlahDebit)
        ?>
    </h5>


</div>
<div class=" card card-primary">
    <div class=" card-header">

        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>Jurnal Umum
        </h5>
    </div>
    <div class=" card-body">
        <div class=" table-responsive">
            <a href="?page=#" class="btn btn-primary h6">
                <i class="fa fa-edit m-2"></i> Tambah Data
            </a>
        </div>
        <table id="example1" class="table table-bordered table-striped m-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan & Tahun</th>
                    <th style="width: 30px;">Detail Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $koneksi->query("SELECT DISTINCT bln.nama_bulan FROM jurnal jurn INNER JOIN bulan bln ON jurn.id_bulan=bln.id_bulan");
                while ($data = $sql->fetch_assoc()) {

                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bulan']; ?></td>
                    <td>
                        <a href="?page=data_jurnal_lihat&kode=<?php echo $data['nama_bulan']; ?>" title="Detail"
                            class=" d-flex justify-content-sm-center btn btn-primary btn-sm">
                            <i class="  fas fa-info-circle"></i>
                        </a>

                    </td>
                </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
