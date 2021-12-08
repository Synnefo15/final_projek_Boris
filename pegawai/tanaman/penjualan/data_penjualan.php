<?php 
    if (isset($_GET['kode'])) {
        $sql_cek=  "SELECT monthname(tgl_pesan) as bulan FROM `penjualan_tanaman` 
        WHERE monthname(tgl_pesan) = '".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
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
                <!-- <a href="?page=add_penjualan" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a> -->
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanaman</th>
                        <th>Supplier</th>
                        <th>Jumlah Beli</th>
                        <th>Customer</th>
                        <th>Tanggal Pesan</th>
                        <th>Tanggal Kirim</th>
                        <!-- <th>Aksi</th> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT tnm.`nama`, 
                                    sup.COMPANY_NAME as supplier,
                                    pt.`jumlah_pembelian`, 					
                                    CONCAT_WS(' ',cus.FIRST_NAME,cus.LAST_NAME) AS `Nama Cus`,
                                    pt.tgl_pesan,
                                    pt.tgl_kirim    
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

                        <td>
                            <!-- <a href="?page=i_edit_km&kode=<?php echo $data['id_km']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=i_del_km&kode=<?php echo $data['id_km']; ?>"
                                onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                                </> -->
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
    <div class=" card-footer">
        <a href="?page=list_penjualan" title="Kembali" class="btn btn-secondary">Kembali</a>
    </div>
    <!-- /.card-body -->
