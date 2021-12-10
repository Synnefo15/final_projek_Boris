<?php 
    if (isset($_GET['kode'])) {
        $sql_cek = "SELECT monthname(tanggal) as bulan FROM `tanaman_masuk` 
        WHERE monthname(tanggal) = '".$_GET['kode']."'";
        $query_cek=mysqli_query($koneksi,$sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class=" card card-primary">
    <div class=" card-header">
        <h4 class=" card-title">
            <i class="fa fa-table"></i>
            Detail Tanaman Masuk
        </h4>
        <br>
        <h5>
            Bulan <?= $_GET['kode']; ?>
        </h5>

    </div>
    <div class=" card-body">
        <div class=" table-responsive">
            <table id="tabel tanaman" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no=1;
                        $sql = $koneksi->query("SELECT tanaman.nama, supplier.COMPANY_NAME, jumlah, tanggal  
                        FROM `tanaman_masuk` tm               
                        INNER JOIN tanaman ON tm.id_tanaman = tanaman.id_tanaman
                        INNER JOIN supplier ON tanaman.id_supplier = supplier.SUPPLIER_ID
                        WHERE monthname(tanggal) = '".$_GET['kode']."' ");
                        while ($data = $sql->fetch_assoc()) {
                            # code...
                        
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['COMPANY_NAME']; ?></td>
                        <td><?= $data['jumlah']; ?></td>
                        <td><?= $data['tanggal']; ?></td>
                    </tr>
                    <?php 
                } ?>
                </tbody>
            </table>

        </div>

    </div>
    <div class=" card-footer">
        <a href="?page=list_tanaman_masuk" title="Kembali" class="btn btn-secondary">Kembali</a>
    </div>


</div>
