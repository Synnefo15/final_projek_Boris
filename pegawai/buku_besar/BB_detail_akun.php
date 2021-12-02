<?php

    if(isset($_GET['bulan'],$_GET['akun'])){
        $sql_cek = "SELECT DISTINCT(akun.nama_akun) as nama_akun
        ,SUM(jurnal.debit) as debit
        ,SUM(jurnal.kredit) as kredit,
        bulan.nama_bulan                
        FROM `jurnal` 
        INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
        INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan 
        WHERE bulan.nama_bulan='".$_GET['bulan']."'
        AND akun.nama_akun='".$_GET['akun']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<?php  
    $sql = $koneksi->query("SELECT * FROM `jurnal` 
    INNER JOIN bulan ON bulan.id_bulan = jurnal.id_bulan 
    WHERE bulan.nama_bulan='".$_GET['bulan']."'");
    while ($data=$sql->fetch_assoc()){
        $namaBulan = $data['nama_bulan'];
    }
?>

<div class=" card card-primary">
    <div class=" card-header">
        <h3 class=" card-title">
            <i class="fa fa-table"></i> Buku Besar Si Boris
        </h3><br>
    </div>
    <div class=" card-title bg-secondary">
        <h3 class=" card-title ml-4"><?= $_GET['bulan']; ?></h3>
    </div>

    <div class=" card-body">
        <div class=" table-responsive">

            <table id="example1" class="table table-bordered table-striped m-2">
                <thead class=" text-center">
                    <tr>
                        <th rowspan="2">Tanggal </th>
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
                        
                        $sql=$koneksi->query("SELECT jurnal.id_jurnal, 
                        CONCAT_WS('-',jurnal.tanggal,jurnal.id_bulan) AS tanggal,
                        jurnal.debit, 
                        jurnal.kredit,
                        (CASE
                            WHEN jurnal.debit > jurnal.kredit THEN jurnal.debit-jurnal.kredit                         
                            
                        END) as saldo_debit,
                        (CASE                            
                            WHEN jurnal.debit < jurnal.kredit THEN jurnal.kredit-jurnal.debit
                            
                        END) as saldo_kredit
                        FROM `jurnal`                         
                        INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
                        INNER JOIN bulan ON jurnal.id_bulan = bulan.id_bulan 
                        WHERE bulan.nama_bulan='".$_GET['bulan']."' 
                        AND akun.nama_akun='".$_GET['akun']."'
                        ");
                        while ($data = $sql->fetch_assoc()) {
                                                    
                        
                    ?>
                    <tr>

                        <td><?= $data['tanggal'] ; ?></td>
                        <td><?= rupiah($data['debit']) ; ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>
                        <td><?= rupiah($data['saldo_debit']); ?></td>
                        <td><?= rupiah($data['saldo_kredit']); ?></td>
                    </tr>

                    <?php  
                    }
                    ?>
                    <?php  
                        // disini nanti ngodingnya. Trus dibuat total harga
                    ?>
                    <tr>
                        <td colspan="3" class=" bg-white text-center text-bold">Saldo</td>
                        <td>debit</td>
                        <td>kredit</td>
                    </tr>
                    <ttr>
                        <td colspan="3" class=" bg-white text-center text-blue text-bold">Total Saldo</td>
                        <td colspan="2" class=" text-center text-blue">rp</td>
                    </ttr>
                </tbody>
            </table>
        </div>
        <div class=" card-footer">
            <a href=" ?page=BB_detail&bulan=<?=$namaBulan?>" title=" Kembali" class="btn btn-secondary">Kembali</a>
        </div>

    </div>


</div>
