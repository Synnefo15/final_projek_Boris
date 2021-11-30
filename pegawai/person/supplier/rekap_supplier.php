<?php 
$sql = $koneksi->query("SELECT COUNT(*) AS 'total supplier' FROM `supplier`");
while ($data=$sql->fetch_assoc()){
    $jumlahSup=$data['total supplier'];
}
 ?>



<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="fas fa-chevron-circle-right"></i>Daftar Supplier
    </h5>
    <h5>Jumlah Total:
        <?php
  echo $jumlahSup;
  ?>
    </h5>


</div>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Daftar Supplier Si Boris
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=person_add_supplier" class="btn btn-primary">
                    <i class="fa fa-edit m-2"></i> Tambah Data
                </a>
            </div>
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Kota</th>
                        <th>Provinsi</th>
                        <th>Phone Number</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
              $no = 1;
              $sql = $koneksi->query("SELECT sup.`SUPPLIER_ID`,sup.`COMPANY_NAME`, loc.`PROVINCE`,loc.`CITY`, sup.`PHONE_NUMBER` FROM `supplier` sup INNER JOIN location loc ON sup.LOCATION_ID = loc.LOCATION_ID ORDER BY SUPPLIER_ID DESC");
              while ($data= $sql->fetch_assoc()) {
            ?>

                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data['COMPANY_NAME']; ?>
                        </td>
                        <td>
                            <?php echo $data['CITY']; ?>
                        </td>
                        <td>
                            <?php echo $data['PROVINCE']; ?>
                        </td>

                        <td>
                            <?php echo $data['PHONE_NUMBER']; ?>

                        </td>
                        <td>
                            <a href="?page=person_update_supplier&kode=<?php echo $data['SUPPLIER_ID']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=person_del_supplier&kode=<?php echo $data['SUPPLIER_ID']; ?>"
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
