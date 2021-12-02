<!-- * paramater -->
<?php

    if(isset($_GET['bulan'])){
        $sql_cek = "SELECT * FROM jurnal 
        INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan
        WHERE bulan.nama_bulan='".$_GET['bulan']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<!-- * Jumlah Akun tersedia -->
<?php 
    $sql = $koneksi->query("SELECT COUNT(DISTINCT akun.nama_akun) as jumlah, bulan.nama_bulan FROM `jurnal` INNER JOIN akun ON jurnal.id_akun = akun.id_akun INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan
    WHERE bulan.nama_bulan = '".$_GET['bulan']."' ");
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
        <?=$jumlahAkun;?>
    </h5>


</div>

<div class=" row">
    <?php  
        $sql = $koneksi->query("SELECT DISTINCT(akun.nama_akun) as nama_akun
        ,SUM(jurnal.debit) as debit
        ,SUM(jurnal.kredit) as kredit        
        FROM `jurnal` 
        INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
        INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan 
        WHERE bulan.nama_bulan='".$_GET['bulan']."' GROUP BY jurnal.id_akun ");
        while ($data = $sql->fetch_assoc()){
            $sumDebit = $data['debit'];
            $sumKredit = $data['kredit'];
        
    ?>
    <!-- * kotak warna -->
    <div class=" col-lg-3 col-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h6>Debit
                    <?php echo rupiah($sumDebit); ?>
                </h6>
                <h6>Kredit
                    <?php echo rupiah($sumKredit); ?>
                </h6>
                <a href="" class=" text-white" title="Detail <?=$data['nama_akun']?> ">
                    <h3 class=" text-center text-bold"><?= $data['nama_akun']; ?></h3>
                </a>
            </div>
            <?php  
            // }
            ?>

            <div class=" icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <input type="submit" name="Detail" value="Detail" class="btn btn-success">
            <a href="?page=#" class="small-box-footer">Selengkapnya
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <?php
    }  
    ?>

</div>

<?php  
    
?>

<div class=" card card-primary">
    <div class=" card-header">
        <h3 class=" card-title">
            <i class="fa fa-table"></i> Buku Besar Si Boris

        </h3>
    </div>

    <div class=" card-body">
        <div class=" table-responsive">

            <table id="example1" class="table table-bordered table-striped m-2">
                <thead class=" text-center">
                    <tr>
                        <th rowspan="2">Tanggal</th>
                        <th rowspan="2">Debit </th>
                        <th rowspan="2">Kredit </th>
                        <th colspan="2">Saldo</th>
                    </tr>
                    <tr>
                        <th>Debit</th>
                        <th>Kredit</th>
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
                        <td>a</td>
                        <td>b</td>
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
