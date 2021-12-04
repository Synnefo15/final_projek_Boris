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
    $sql = $koneksi->query("SELECT COUNT(DISTINCT akun.nama_akun) as jumlah, 
    bulan.nama_bulan FROM `jurnal` 
    INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
    INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan
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
<div class=" card card-secondary">
    <div class=" card-title bg-secondary">
        <h2 class=" card-title align-content-center p-2" style=" font-size: 25px;"><?= $_GET['bulan']; ?></h2>

    </div>

</div>

<div class=" row">
    <?php  
        $sql = $koneksi->query("SELECT DISTINCT(akun.nama_akun) as nama_akun
        ,SUM(jurnal.debit) as debit
        ,SUM(jurnal.kredit) as kredit,
        bulan.nama_bulan,
        (CASE
            WHEN SUM(jurnal.debit) > SUM(jurnal.kredit) THEN SUM(jurnal.debit)-SUM(jurnal.kredit)                         
            
        END) as saldo_debit,
        (CASE                            
            WHEN SUM(jurnal.debit) < SUM(jurnal.kredit) THEN SUM(jurnal.kredit)-SUM(jurnal.debit)
            
        END) as saldo_kredit                
        FROM `jurnal` 
        INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
        INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan 
        WHERE bulan.nama_bulan='".$_GET['bulan']."' GROUP BY jurnal.id_akun ");
        while ($data = $sql->fetch_assoc()){
            $sumDebit = $data['debit'];
            $sumKredit = $data['kredit'];
            $saldoDebit=$data['saldo_debit'];
            $saldoKredit=$data['saldo_kredit'];
        
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
                <h3 class=" text-center text-bold"><?= $data['nama_akun']; ?></h3>
                <h6>Saldo Debit : <?= rupiah($saldoDebit); ?></h6>
                <h6>Saldo Kredit : <?= rupiah($saldoKredit); ?></h6>
            </div>


            <div class=" icon">
                <i class="ion ion-stats-bars"></i>
            </div>

            <a href="?page=BB_detail_akun&bulan=<?=$data['nama_bulan']?>&akun=<?=$data['nama_akun'];?>"
                class="small-box-footer">Selengkapnya
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <?php
    }  
    ?>

</div>

<div class=" card">
    <div class=" card-body">
        <div>
            <?php 
                $sql=$koneksi->query("SELECT SUM(debit) as debit, SUM(kredit) as kredit
                FROM `jurnal`
                INNER JOIN bulan ON bulan.id_bulan = jurnal.id_bulan
                WHERE bulan.nama_bulan = '".$_GET['bulan']."'");
                while ($data=$sql->fetch_assoc()) {
                    
                
            ?>
            <h5>
                Total Debit:
                <?= rupiah($data['debit']); ?>
            </h5>
            <h5>Total Kredit:
                <?= rupiah($data['kredit']); ?>
            </h5>
        </div>
        <?php  
        }
        ?>
        <div class=" card-footer">
            <a href=" ?page=lihat_BB" title=" Kembali" class="btn btn-secondary" style="width: 150px; ">Kembali</a>
        </div>
    </div>
</div>
