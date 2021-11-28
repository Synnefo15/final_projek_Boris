<?php 
$sqlDebit = $koneksi->query("SELECT SUM(debit) FROM `jurnal`");
while($data = $sqlDebit->fetch_assoc()){
    $jumlahDebit=$data['total debit'];
}
?>
<?php  
$sqlKredit = $koneksi->query("");
while ($data=$sqlKredit->fetch_assoc()){
$jumlahKredit=$data['total kredit'];
}
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h3>
        <i class="icon fas fa-info"></i> Total Debit
    </h3>
    <h2>Jumlah Total:
        <?php
        echo $jumlahDebit;
        ?>
    </h2>
    <h3>
        <i class="icon fas fa-info"></i> Total Kredit
    </h3>
    <h2>Jumlah Total:
        <?php
        echo $jumlahKredit;
        ?>
    </h2>


</div>
