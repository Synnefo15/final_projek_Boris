<?php 
$sql = $koneksi->query("SELECT SUM(debit) as 'total debit' FROM `jurnal`");
while($data = $sql->fetch_assoc()){
    $jumlahDebit=$data['total debit'];
}
?>

<?php  
$sql = $koneksi->query("SELECT SUM(kredit) as 'total kredit' FROM `jurnal`");
while ($data=$sql->fetch_assoc()){
$jumlahKredit=$data['total kredit'];
}
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>
        <i class="icon fas fa-info"></i> Total Debit
    </h5>
    <h5>Jumlah Total:
        <?php
        echo rupiah($jumlahDebit)
        ?>
    </h5>
    <h5>
        <i class="icon fas fa-info"></i> Total Kredit
    </h5>
    <h5>Jumlah Total:
        <?php
        echo rupiah($jumlahDebit)
        ?>
    </h5>


</div>
