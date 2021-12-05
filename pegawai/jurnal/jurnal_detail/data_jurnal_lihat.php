<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM jurnal 
        WHERE id_bulan='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<?php  
$sql = $koneksi->query("SELECT nama_bulan FROM `bulan` WHERE nama_bulan='".$_GET['kode']."'");
while ($data = $sql->fetch_assoc()) {
    $namaBulan = $data['nama_bulan'];
}
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Jurnal Bulan :
    </h5>
    <h5>
        <?php
        echo $namaBulan;
        ?>
    </h5>


</div>
<div class=" card card-primary">
    <div class=" card-header">
        <h3 class=" card-title">
            <i class="fa fa-table"></i> Jurnal Umum Si Boris

        </h3>
    </div>

    <div class=" card-body">
        <div class=" table-responsive">
            <div>
                <a href="?page=add_data_jurnal&kode=<?=$namaBulan ;?>" class=" btn btn-primary">
                    <i class="fa fa-edit m-2"></i> Tambah Data
                </a>
            </div>
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th style="width:20px">Tanggal</th>
                        <th style="width:20px">Id akun </th>
                        <th style="width:105px">Nama akun </th>
                        <th style="width:90px">Debit </th>
                        <th style="width:90px">Kredit </th>
                        <th>Deskripsi</th>
                        <th style="width: 60px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        
                        $sql=$koneksi->query("SELECT id_jurnal,concat_ws('-',jurn.tanggal,bln.nama_bulan) as tanggal ,
                        jurn.id_akun,akun.nama_akun, 
                        jurn.debit, jurn.kredit,
                        jurn.deskripsi
                        FROM `jurnal` jurn 
                        INNER JOIN akun akun ON jurn.id_akun = akun.id_akun 
                        INNER JOIN bulan bln ON jurn.id_bulan = bln.id_bulan 
                        WHERE bln.nama_bulan='".$_GET['kode']."'");
                        while ($data = $sql->fetch_assoc()) {                            
                        
                    ?>
                    <tr>

                        <td><?= $data['tanggal']; ?></td>
                        <td><?= $data['id_akun']; ?></td>
                        <td><?= $data['nama_akun']; ?></td>
                        <td><?= rupiah($data['debit']) ; ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>
                        <td><?= $data['deskripsi']; ?></td>
                        <td>
                            <a href=" ?page=update_data_jurnal&kode=<?=$namaBulan?>&id_jurnal=<?=$data['id_jurnal']; ?>"
                                title="Ubah" class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del_data_jurnal&kode=<?=$namaBulan?>&id_jurnal=<?=$data['id_jurnal']; ?>"
                                onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                                </>
                        </td>
                    </tr>
                    <?php  
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class=" card-footer">
            <a href=" ?page=data_jurnal" title=" Kembali" class="btn btn-secondary">Kembali</a>
        </div>

    </div>


</div>
