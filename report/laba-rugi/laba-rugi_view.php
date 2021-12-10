<?php
    

    if(isset($_GET['bulan'])){
        $sql_cek = "SELECT * FROM jurnal 
        WHERE monthname(tgl)='".$_GET['bulan']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<!-- //*Pendapatan -->
<?php 
    $sqlPendapatan = $koneksi->query("SELECT (CASE 
        WHEN SUM(saldo_debit) > SUM(saldo_kredit) THEN SUM(saldo_debit)-SUM(saldo_kredit)
    END) as tot_deb,
    (CASE 
        WHEN SUM(saldo_debit) < SUM(saldo_kredit) THEN SUM(saldo_kredit)-SUM(saldo_debit)
    END) as tot_kre
    FROM `saldo` 
    WHERE bulan = '".$_GET['bulan']."' AND  id_akun LIKE '4%'");
    while ($pendapatan = $sqlPendapatan->fetch_assoc()) {
        $pTotDeb = $pendapatan['tot_deb'];
        $pTotKre = $pendapatan['tot_kre'];
        $pHasilDeb = $pendapatan['tot_deb'] - $pendapatan['tot_kre'];
        $pHasilKre = $pendapatan['tot_kre'] - $pendapatan['tot_deb'];
    }
?>
<!-- //*Beban -->
<?php 
    $sqlBeban = $koneksi->query("SELECT (CASE 
        WHEN SUM(saldo_debit) > SUM(saldo_kredit) THEN SUM(saldo_debit)-SUM(saldo_kredit)
    END) as tot_deb,
    (CASE 
        WHEN SUM(saldo_debit) < SUM(saldo_kredit) THEN SUM(saldo_kredit)-SUM(saldo_debit)
    END) as tot_kre
    FROM `saldo` 
    WHERE bulan = '".$_GET['bulan']."' AND  id_akun LIKE '5%'");
    while ($beban = $sqlBeban->fetch_assoc()) {
        $bTotDeb = $beban['tot_deb'];
        $bTotKre = $beban['tot_kre'];
        $bHasilDeb=$beban['tot_deb']-$beban['tot_kre'];
        $bHasilKre=$beban['tot_kre']-$beban['tot_deb'];
    }
?>

<div class=" card card-info">
    <div class=" card-header">
        <h3 class=" card-title">Laporan Laba Rugi</h3>
    </div>
    <div class=" card-title bg-secondary">
        <h3 class=" card-title m-3 "><?= $_GET['bulan']; ?></h3>
    </div>
    <div class=" card-body">
        <div class=" table-responsive">
            <table class=" table table-bordered table-striped m-2">
                <thead class=" text-center">

                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Nama Akun</th>
                        <th colspan="2">Jumlah</th>
                    </tr>
                    <tr>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- //* Pendapatan -->
                    <tr>
                        <td colspan="6" class=" text-bold text-center"> Pendapatan</td>
                    </tr>
                    <?php 
                        $no=1;
                        $sql=$koneksi->query("SELECT akun.nama_akun, bulan, saldo_debit, saldo_kredit                        
                        FROM `saldo` 
                        INNER JOIN akun ON akun.id_akun = saldo.id_akun
                        WHERE bulan = '".$_GET['bulan']."' AND saldo.id_akun LIKE '4%'");
                        while ($data = $sql->fetch_assoc()) {
                            
                        
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_akun']; ?></td>
                        <td><?= rupiah($data['saldo_debit']); ?></td>
                        <td><?= rupiah($data['saldo_kredit']); ?></td>
                        <?php 
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class=" text-center">TOTAL</td>
                        <td><?= rupiah($pTotDeb); ?></td>
                        <td><?= rupiah($pTotKre); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class=" text-center text-blue">
                            <?php 
                                if ($pTotDeb > $pTotKre) {
                                    echo rupiah($pHasilDeb)  ;
                                    echo " (Debit)";
                                }else {
                                    echo rupiah($pHasilKre) ;
                                    echo  " (Kredit)";
                                }
                            ?>
                        </td>
                    </tr>
                    <!-- //*BEBAN -->
                    <tr>
                        <td colspan="6" class=" text-bold text-center">BEBAN</td>
                    </tr>
                    <?php 
                        $no=1;
                        $sql=$koneksi->query("SELECT akun.nama_akun, bulan, saldo_debit, saldo_kredit                        
                        FROM `saldo` 
                        INNER JOIN akun ON akun.id_akun = saldo.id_akun
                        WHERE bulan = '".$_GET['bulan']."' AND saldo.id_akun LIKE '5%'");
                        while ($data = $sql->fetch_assoc()) {
                            
                        
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['nama_akun']; ?></td>
                        <td><?= rupiah($data['saldo_debit']); ?></td>
                        <td><?= rupiah($data['saldo_kredit']); ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" class=" text-center">TOTAL</td>
                        <td><?= rupiah($bTotDeb); ?></td>
                        <td><?= rupiah($bTotKre); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class=" text-center text-blue">
                            <?php 
                                if ($bTotDeb > $bTotKre) {
                                    echo rupiah($bHasilDeb)  ;
                                    echo " (Debit)";
                                }else {
                                    echo rupiah($bHasilKre) ;
                                    echo  " (Kredit)";
                                }
                            ?>
                        </td>
                    </tr>

                </tbody>
            </table>
            <div class=" content p-4" style="font-size: 20px;">
                <?php 
                    if ($pHasilKre>$bHasilDeb) {
                        echo "Laba Bersih = " ;
                        echo rupiah($pHasilKre-$bHasilDeb);
                    }elseif ($pHasilKre<$bHasilDeb) {
                        echo "Rugi Bersih = ";
                        echo rupiah($bHasilDeb-$pHasilKre);
                    }
                ?>
            </div>
        </div>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class=" card-footer">
            <a href=" ?page=lap_laba-rugi" title=" Kembali" class="btn btn-secondary">Kembali</a>
            <input type="submit" name="unduh" value="unduh" class="btn btn-info">

        </div>
    </form>
</div>
<?php 
    if (isset($_POST['unduh'])) {
        echo "<script>window.print()
        </script>";
    }
?>
