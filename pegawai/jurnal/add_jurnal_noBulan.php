<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Jurnal
        </h3>

    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" id="tgl" name="tgl" required>
                </div>
                <!-- <div class="col-sm-2">
                    <input type="number" class="form-control" id="id_bulan" name="id_bulan" required>
                </div> -->

            </div>

            <div class="form-group row dropdown">
                <label for="" class="col-sm-2 col-form-label">Nama Akun</label>

                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="id_akun"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="id_akun" required>
                    Pilih Lokasi
                    <option value="" disabled selected>---Pilih Akun---</option>
                    <?php $sql = "SELECT * FROM akun";
                    $kueri = mysqli_query($koneksi, $sql);
                    while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                    <option value="<?= $data['1']; ?>"><?= $data['2']; ?></option>
                    <?php
                    }
                    ?>
                </select>

            </div>




            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Debit (Rp.)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="debit" name="debit"
                        placeholder="Jumlah Pemasukan Debit">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Kredit (Rp.)</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kredit" name="kredit"
                        placeholder="Jumlah Pemasukan Kredit">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Uraian</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        placeholder="Uraian Transaksi" required>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href=" ?page=data_jurnal" title=" Batal" class="btn btn-secondary">Batal</a>
        </div>
    </form>
    <!-- * Data yang baru ditambahkan -->
    <div class="card-body">
        <div class="table-responsive">

            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>Tanggal/Bulan</th>
                        <th>Id akun </th>
                        <th>Nama akun </th>
                        <th>Debit </th>
                        <th>Kredit </th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    $sql = $koneksi->query("SELECT jurn.tgl as tanggal ,jurn.id_akun,akun.nama_akun, jurn.debit, jurn.kredit FROM `jurnal` jurn 
                    INNER JOIN akun akun ON jurn.id_akun = akun.id_akun 
                    ORDER BY jurn.id_jurnal DESC LIMIT 6 ");
                    while ($data = $sql->fetch_assoc()) {

                    ?>
                    <tr>

                        <td><?= $data['tanggal']; ?></td>
                        <td><?= $data['id_akun']; ?></td>
                        <td><?= $data['nama_akun']; ?></td>
                        <td><?= rupiah($data['debit']); ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>

                    </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php

if (isset($_POST['Simpan'])) {

    // *menangkap post debit
    $debit = $_POST['debit'];

    // *menangkap post kredit
    $kredit = $_POST['kredit'];

    //membuang Rp dan Titik
    $hasil_debit = preg_replace("/[^0-9]/", "", $debit);
    $hasil_kredit = preg_replace("/[^0-9]/", "", $kredit);

    //mulai proses simpan data
    $sql_simpan = "INSERT INTO `jurnal`( `id_akun`, `debit`, `kredit`,  `tgl`, `deskripsi`) VALUES (
        '" . $_POST['id_akun'] . "',
        '" . $hasil_debit . "',
        '" . $hasil_kredit . "',
        
        '" . $_POST['tgl'] . "',
        '" . $_POST['deskripsi'] . "')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data_jurnal';
          }
      })</script>";
    } else {
        echo "<script>
Swal.fire({
    title: 'Tambah Data Gagal',
    text: '',
    icon: 'error',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.value) {
        window.location = 'index.php?page=data_jurnal';
    }
})
</script>";
    }
}
//selesai proses simpan data

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
