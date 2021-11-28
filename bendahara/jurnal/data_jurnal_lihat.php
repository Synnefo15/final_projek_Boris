<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM jurnal WHERE id_bulan='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<div class=" card card-primary">
    <div class=" card-header">
        <h3 class=" card-title">
            <i class="fa fa-table"></i> Jurnal Umum Si Boris

        </h3>
    </div>

    <div class=" card-body">
        <div class=" table-responsive">
            <div>
                <a href="?page=#" class="btn btn-primary">
                    <i class="fa fa-edit m-2"></i> Tambah Data
                </a>
            </div>
            <table id="example1" class="table table-bordered table-striped m-2">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Id akun </th>
                        <th>Nama akun </th>
                        <th>Debit </th>
                        <th>Kredit </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        
                        $sql=$koneksi->query("SELECT concat_ws('-',jurn.tanggal,bln.nama_bulan) as tanggal ,jurn.id_akun,akun.nama_akun, jurn.debit, jurn.kredit FROM `jurnal` jurn INNER JOIN akun akun ON jurn.id_akun = akun.id_akun INNER JOIN bulan bln ON jurn.id_bulan = bln.id_bulan WHERE bln.nama_bulan='".$_GET['kode']."'");
                        while ($data = $sql->fetch_assoc()) {                            
                        
                    ?>
                    <tr>

                        <td><?= $data['tanggal']; ?></td>
                        <td><?= $data['id_akun']; ?></td>
                        <td><?= $data['nama_akun']; ?></td>
                        <td><?= rupiah($data['debit']) ; ?></td>
                        <td><?= rupiah($data['kredit']); ?></td>
                        <td>
                            <a href="?page=#&kode=<?php echo $data['id_km']; ?>" title="Ubah"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=#&kode=<?php echo $data['id_km']; ?>"
                                onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus"
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                                </>
                        </td>
                    </tr>
                    <?php  
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>


</div>
