<div class=" card card-primary">
    <div class=" card-header">

        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>Buku Besar
        </h5>
    </div>


    <div class=" card-body">

        <table id="example1" class="table table-bordered table-striped m-2">
            <thead>
                <tr>
                    <th style="width: 15px;">No</th>
                    <th style="width: 130px;">Bulan</th>
                    <th style="width: 30px;">Detail Buku Besar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $koneksi->query("SELECT DISTINCT bln.nama_bulan FROM jurnal jurn INNER JOIN bulan bln ON jurn.id_bulan=bln.id_bulan");
                while ($data = $sql->fetch_assoc()) {

                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bulan']; ?></td>
                    <td>
                        <a href="?page=BB_detail&bulan=<?php echo $data['nama_bulan']; ?>" title="Detail"
                            class=" d-flex justify-content-sm-center btn btn-primary btn-sm">
                            <i class="  fas fa-info-circle"></i>
                        </a>

                    </td>
                </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</div>
