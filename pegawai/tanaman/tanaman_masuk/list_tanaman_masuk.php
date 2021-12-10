<div class=" card card-primary">
    <div class=" card-header">

        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>Tanaman Masuk
        </h5>
    </div>
    <div class=" card-body">

        <table id="example1" class="table table-bordered table-striped m-2">
            <thead>
                <tr>
                    <th style="width: 15px;">No</th>
                    <th>Bulan</th>
                    <th style="width: 30px;">Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $koneksi->query("SELECT monthname(tanggal) as bulan FROM `tanaman_masuk`                 
                GROUP BY month(tanggal)");
                while ($data = $sql->fetch_assoc()) {

                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['bulan']; ?></td>
                    <td>
                        <a href="?page=detail_tanaman_masuk&kode=<?php echo $data['bulan']; ?>" title="Detail"
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
