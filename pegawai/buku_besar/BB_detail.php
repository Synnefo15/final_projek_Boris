<?php

    if(isset($_GET['bulan'])){
        $sql_cek = "SELECT * FROM jurnal WHERE id_bulan='".$_GET['bulan']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<?php 
    $sql = $koneksi->query("SELECT COUNT(DISTINCT akun.nama_akun) as jumlah FROM `jurnal` INNER JOIN akun ON jurnal.id_akun = akun.id_akun");
    while ($data = $sql->fetch_assoc()) {
        $jumlahAkun = $data['jumlah'];
    }
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Buku Besar Tersedia :
    </h5>
    <h5>
        <?php
        
        echo $jumlahAkun;
        ?>
    </h5>


</div>

<div class=" row">
    <div class=" col-lg-6 col-6"></div>

</div>

<div class=" card card-primary">
    <div class=" card-header">
        <h3 class=" card-title">
            <i class="fa fa-table"></i> Buku Besar Si Boris

        </h3>
    </div>

    <div class=" card-body">
        <div class=" table-responsive">

            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Debit </th>
                        <th>Kredit </th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        
                        $sql=$koneksi->query("SELECT id_jurnal,concat_ws('-',jurn.tanggal,bln.nama_bulan) as tanggal, jurn.debit, jurn.kredit FROM `jurnal` jurn INNER JOIN akun akun ON jurn.id_akun = akun.id_akun INNER JOIN bulan bln ON jurn.id_bulan = bln.id_bulan WHERE bln.nama_bulan='".$_GET['bulan']."'");
                        while ($data = $sql->fetch_assoc()) {                            
                        
                    ?>
                    <tr>

                        <td><?= $data['tanggal']; ?></td>
                        <td><?= rupiah($data['debit']) ; ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>
                        <td>

                        </td>
                    </tr>
                    <?php  
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class=" card-footer">
            <a href=" ?page=#" title=" Kembali" class="btn btn-secondary">Kembali</a>
        </div>

    </div>


</div>
