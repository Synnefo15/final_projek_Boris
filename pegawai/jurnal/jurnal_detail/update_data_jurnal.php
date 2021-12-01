<?php
if (isset($_GET['kode'],$_GET['id_jurnal'])) {
    $sql_cek = "SELECT * FROM jurnal INNER JOIN akun ON jurnal.id_akun=akun.id_akun WHERE id_jurnal='".$_GET['id_jurnal']."' ";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    
    $sql = $koneksi->query("SELECT * FROM `bulan` WHERE nama_bulan='".$_GET['kode']."'");
while ($data = $sql->fetch_assoc()) {
    $namaBulan = $data['nama_bulan'];
}}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Jurnal
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type='hidden' class="form-control" name="id_jurnal" value="<?=$data_cek['id_jurnal']; ?>" readonly />

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal-Bulan</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="tanggal" name="tanggal"
                        value="<?=$data_cek['tanggal']?>" />
                </div>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="id_bulan" name="id_bulan"
                        value="<?=$data_cek['id_bulan']?>" />
                </div>

            </div>

            <div class="form-group row dropdown">
                <label for="" class="col-sm-2 col-form-label">Nama Akun</label>

                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="id_akun"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="id_akun"
                    style="color: white; ">

                    <option value="<?=$data_cek['id_akun']?>" selected><?= $data_cek['nama_akun']; ?></option>
                    <?php $sql = "SELECT * FROM akun";
                    $kueri = mysqli_query($koneksi, $sql);
                    while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                    <option value=" <?= $data['0']; ?>"><?= $data['1']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Debit (Rp.)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="debit" name="debit" value="<?=$data_cek['debit']?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Kredit (Rp.)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kredit" name="kredit"
                        value="<?=$data_cek['kredit']?>" />
                </div>
            </div>

            <div class=" form-group row">
                <label class="col-sm-2 col-form-label">Uraian</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        value="<?=$data_cek['deskripsi']?>" />
                </div>
            </div>


        </div>
        <div class=" card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data_jurnal_lihat&kode=<?= $namaBulan; ?>" title="Kembali"
                class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php

    if (isset ($_POST['Ubah'])){

        // *menangkap post debit
    $debit = $_POST['debit'];

    // *menangkap post kredit
    $kredit = $_POST['kredit'];

    //membuang Rp dan Titik
    $hasil_debit = preg_replace("/[^0-9]/", "", $debit);
    $hasil_kredit = preg_replace("/[^0-9]/", "", $kredit);

	

    $sql_ubah = "UPDATE jurnal SET
        id_akun='".$_POST['id_akun']."',
        debit='".$hasil_debit."',
        kredit='".$hasil_kredit."',
        id_bulan='" . $_POST['id_bulan'] . "',
        tanggal='" . $_POST['tanggal'] . "',
        deskripsi='" . $_POST['deskripsi'] . "'
        WHERE id_jurnal='".$_POST['id_jurnal']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data_jurnal_lihat&kode=$namaBulan';
        }
        })</script>";
    }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data_jurnal_lihat&kode=$namaBulan';
        }
        })</script>";
	}}
	
	?>

<script type="text/javascript">
var debit = document.getElementById('debit');
debit.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    debit.value = formatmasuk(this.value, 'Rp ');
});
var kredit = document.getElementById('kredit');
kredit.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    kredit.value = formatmasuk(this.value, 'Rp ');
});

/* Fungsi formatmasuk */
function formatmasuk(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        masuk = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        masuk += separator + ribuan.join('.');
    }

    masuk = split[1] != undefined ? masuk + ',' + split[1] : masuk;
    return prefix == undefined ? masuk : (masuk ? 'Rp ' + masuk : '');
}
</script>
