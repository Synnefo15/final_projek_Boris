<?php

    if(isset($_GET['bulan'],$_GET['akun'])){
        $sql_cek = "SELECT DISTINCT(akun.nama_akun) as nama_akun
        ,SUM(jurnal.debit) as debit
        ,SUM(jurnal.kredit) as kredit,
        monthname(tgl) as nama_bulan                
        FROM `jurnal` 
        INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
        
        WHERE monthname(tgl)='".$_GET['bulan']."'
        AND akun.nama_akun='".$_GET['akun']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<?php  
    $sql = $koneksi->query("SELECT monthname(tgl) as nama_bulan FROM `jurnal` 
    
    WHERE monthname(tgl)='".$_GET['bulan']."'");
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
                        tgl AS tanggal,
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
                        
                        WHERE monthname(tgl)='".$_GET['bulan']."' 
                        AND akun.nama_akun='".$_GET['akun']."'
                        ");
                        while ($data = $sql->fetch_assoc()) {
                                                    
                        
                    ?>
                    <tr>

                        <td><?= $data['tanggal'] ; ?></td>
                        <td class=" text-right"><?= rupiah($data['debit']) ; ?></td>
                        <td class=" text-right"><?= rupiah($data['kredit']); ?></td>
                        <td class=" text-right"><?= rupiah($data['saldo_debit']); ?></td>
                        <td class=" text-right"><?= rupiah($data['saldo_kredit']); ?></td>
                    </tr>

                    <?php  
                    }
                    ?>
                    <?php  
                        // disini nanti ngodingnya. Trus dibuat total harga
                        $sql = $koneksi-> query("SELECT 
                        SUM(jurnal.debit) as 'total debit', 
                        SUM(jurnal.kredit) as 'total kredit',
                        (CASE 
                        WHEN SUM(jurnal.debit) > SUM(jurnal.kredit) THEN SUM(jurnal.debit)-SUM(jurnal.kredit)                         
                        END) as 'saldo debit',
                        (CASE                                                       
                        WHEN SUM(jurnal.debit) < SUM(jurnal.kredit) THEN SUM(jurnal.kredit)-SUM(jurnal.debit)                           
                        END) as 'saldo kredit'
                        FROM `jurnal`                                                 
                        INNER JOIN akun ON jurnal.id_akun = akun.id_akun 
                        
                        WHERE monthname(tgl)='".$_GET['bulan']."' 
                        AND akun.nama_akun='".$_GET['akun']."'");
                        while ($data=$sql->fetch_assoc()) {
                            
                        
                    ?>
                    <tr>
                        <td colspan="3" class=" bg-white text-center text-bold">Saldo</td>
                        <td class=" text-right"><?= rupiah($data['total debit']); ?></td>
                        <td class=" text-right"><?= rupiah($data['total kredit']); ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class=" bg-white text-center text-blue text-bold">Total Saldo
                            <?php  
                                if ($data['saldo debit'] > $data['saldo kredit']) {
                                    echo "(Debit)";
                                }else {
                                    echo "(Kredit)";
                                }
                            ?>

                        </td>
                        <td colspan="2" class=" text-center text-blue">
                            <?php  
                            if ($data['saldo debit'] > $data['saldo kredit']) {
                            echo rupiah($data['saldo debit']);
                            }else{
                            echo rupiah($data['saldo kredit']);
                            }
                            ?>

                        </td>
                    </tr>
                    <?php
                    }  
                    ?>
                </tbody>
            </table>
        </div>
        <div class=" card-footer">
            <a href=" ?page=BB_detail&bulan=<?=$namaBulan?>" title=" Kembali" class="btn btn-secondary">Kembali</a>
        </div>

    </div>


</div>
