<?php

if (isset($_GET['id'])) {
    $sql_cek = "SELECT * FROM tanaman
    INNER JOIN supplier ON supplier.SUPPLIER_ID = tanaman.id_supplier
    WHERE id_tanaman='" . $_GET['id'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>


<div class=" card card-success">
    <div class=" card-header">
        <div class=" card-title">
            <i class="fa fa-edit"></i> Ubah Tanaman
        </div>
    </div>

    <form action="" method="post" enctype="multipart/form-data">
        <div class=" card-body">
            <input type="hidden" class=" form-control" name=" id_tanaman" value=" <?= $data_cek['id_tanaman'] ?>"
                readonly>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Tanaman</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="<?php echo $data_cek['nama']; ?>" required />
                </div>
            </div>

            <div class="form-group row dropdown">
                <label for="" class="col-sm-2 col-form-label">Nama Supplier</label>

                <select class=" col-sm-5 p-2 ml-2 btn btn-success dropdown-toggle" type="button" id="id_supplier"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="id_supplier" required>

                    <option value="<?=$data_cek['id_supplier']?>" selected>
                        <?= $data_cek['COMPANY_NAME']; ?>
                    </option>
                    <?php $sql = "SELECT * FROM supplier";
                    $kueri = mysqli_query($koneksi, $sql);
                    while ($data = mysqli_fetch_array($kueri)) {

                    ?>
                    <option value="<?= $data['0']; ?>"><?= $data['1']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- <div class=" form-group row">
                <label for="" class="col-sm-2 col-form-label">Stok Masuk</label>
                <div class=" col-sm-8">
                    <input type="number" class=" form-control" id="stok_masuk" name="stok_masuk"
                        placeholder="Masukkan jumlah stok masuk" required value="<?=$data_cek['stok_masuk']?>">
                </div>
            </div>
            <div class=" form-group row">
                <label for="" class="col-sm-2 col-form-label">Stok Keluar</label>
                <div class=" col-sm-8">
                    <input type="number" class=" form-control" id="stok_keluar" name="stok_keluar"
                        placeholder="Masukkan jumlah stok keluar" required value="<?=$data_cek['stok_keluar']?>">
                </div>
            </div> -->
            <div class=" form-group row">
                <label class="col-sm-2 col-form-label">Harga Jual</label>
                <div class=" col-sm-8">
                    <input type="text" class=" form-control" id="harga_jual" name="harga_jual"
                        placeholder="Masukkan harga jual" required value="<?=$data_cek['harga_jual'] ?>">
                </div>
            </div>
            <div class=" form-group row">
                <label class="col-sm-2 col-form-label">Harga Supplier</label>
                <div class=" col-sm-8">
                    <input type="text" class=" form-control" id="harga_supplier" name="harga_supplier"
                        placeholder="Masukkan harga supplier" required value="<?=$data_cek['harga_supplier'] ?>">
                </div>
            </div>
        </div>
        <div class=" card-footer">
            <input type="submit" name="Ubah" value="Ubah" class="btn btn-success" title="Ubah">
            <a href="?page=daftar_tanaman" title="Batal" class="btn btn-secondary">Batal</a>
        </div>
    </form>

</div>
<?php 
    if (isset($_POST['Ubah'])) {
        
        $hargaJual = $_POST['harga_jual'];
        $hargaSupplier = $_POST['harga_supplier'];

        $hasil_HJ = preg_replace("/[^0-9]/", "", $hargaJual);
        $hasil_HS = preg_replace("/[^0-9]/", "", $hargaSupplier);

        $sql_ubah = "UPDATE `tanaman` SET
        `nama`='".$_POST['nama']."',
        `id_supplier`='".$_POST['id_supplier']."',        
        `harga_jual`='".$hasil_HJ."',
        `harga_supplier`='".$hasil_HS."' 
        WHERE id_tanaman='".$_POST['id_tanaman']."'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
        mysqli_close($koneksi);

        if ($query_ubah) {
            if ($hasil_HJ > $hasil_HS) {
                
                echo "<script>
                Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=daftar_tanaman';
                    }
                })</script>";
            } else{                
                    
                echo "<script>
                Swal.fire({title: 'Nilai Harga Jual harus > Harga supplier',text: '',icon: 'warning',confirmButtonText: 'OK'
                }).then((result) => {if (result.value){
                    window.location = 'index.php?page=update_tanaman&id=$data_cek[id_tanaman]';
                    }
                })</script>";
            }
            
        } 
        else {
            echo "<script>
            Swal.fire({
                title: 'Ubah Data Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=daftar_tanaman';
                }
            })
            </script>";
        }
    }
?>


<script type="text/javascript">
var harga_jual = document.getElementById('harga_jual');
harga_jual.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    harga_jual.value = formatmasuk(this.value, 'Rp ');
});
var harga_supplier = document.getElementById('harga_supplier');
harga_supplier.addEventListener('keyup', function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatmasuk() untuk mengubah angka yang di ketik menjadi format angka
    harga_supplier.value = formatmasuk(this.value, 'Rp ');
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
