<div class=" card card-primary">
    <div class=" card-header">
        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>
            Neraca Saldo
        </h5>
    </div>
    <div class=" card-body">
        <table class=" table table-bordered table-striped m-2">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                    $no=1;
                    $sql = $koneksi->query("SELECT DISTINCT bln.nama_bulan FROM jurnal jurn 
                    INNER JOIN bulan bln ON jurn.id_bulan=bln.id_bulan");
                    while ($data = $sql->fetch_assoc()) {
                        
                    
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bulan']; ?></td>
                    <td>
                        <a href="?page=neraca_detail&bulan=<?php echo $data['nama_bulan']; ?>" title="Detail"
                            class=" d-flex justify-content-center btn btn-primary btn-sm ">
                            <i class="  fas fa-info-circle"></i>
                        </a>
                    </td>
                </tr>
                <?php 
            } ?>
            </tbody>
        </table>
    </div>
</div>
