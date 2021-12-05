<?php 
    if (isset($_GET['bulan'])) {
        $sql_cek = "SELECT * FROM jurnal
        WHERE id_bulan='".$_GET['bulan']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }    
?>
<div class=" card card-primary">
    <div class=" card-header">
        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>
            Neraca Saldo -- <?= $_GET['bulan']; ?>
        </h5>
    </div>

    <div class=" card-body">
        <div class=" table-responsive">
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead class=" text-center">
                    <tr>
                        <!-- <th rowspan="2">ID Akun</th> -->
                        <th rowspan="2">Nama Akun</th>
                        <th colspan="2">Transaksi</th>
                        <th colspan="2">Saldo</th>
                    </tr>
                    <tr>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                    </tr>
                </thead>
                <tbody>
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
                        while ($data = $sql->fetch_assoc()) {
                            // $sumDebit = $data['debit'];
                            // $sumKredit = $data['kredit'];
                            // $saldoDebit=$data['saldo_debit'];
                            // $saldoKredit=$data['saldo_kredit'];
                        
                    ?>
                    <tr>
                        <!-- <td></td> -->
                        <td><?= $data['nama_akun']; ?></td>
                        <td><?= rupiah($data['debit']); ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>
                        <td><?= rupiah($data['saldo_debit']); ?></td>
                        <td><?= rupiah($data['saldo_kredit']); ?></td>
                    </tr>
                    <?php 
                    }
                    ?>

                    <tr>
                        <td class=" text-bold">Total</td>
                        <?php 
                        $sql = $koneksi->query("SELECT SUM(debit) as debit, SUM(kredit) as kredit 
                        FROM jurnal
                        INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan
                        WHERE bulan.nama_bulan = '".$_GET['bulan']."'");
                        while($data = $sql->fetch_assoc()){
                            
                        
                    ?>
                        <td><?= rupiah($data['debit']); ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>
                        <?php 
                        } ?>

                        <?php 
                            $sql=$koneksi->query("SELECT SUM(saldo_debit) as SD, SUM(saldo_kredit) as SK 
                            FROM `saldo` 
                            WHERE bulan = '".$_GET['bulan']."'");
                            while ($data = $sql->fetch_assoc()) {
                                
                            
                        ?>
                        <td><?= rupiah($data['SD']); ?></td>
                        <td><?= rupiah($data['SK']); ?></td>
                        <?php 
                        } ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class=" card-footer">
            <a href=" ?page=BB_detail&bulan=<?=$_GET['bulan']?>" title=" Kembali" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
