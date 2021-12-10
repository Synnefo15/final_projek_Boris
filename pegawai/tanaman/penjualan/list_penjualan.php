<div class=" card card-primary">
    <div class=" card-header">

        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>Penjualan Tanaman
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
                $sql = $koneksi->query("SELECT monthname(tgl_pesan) as bulan FROM `penjualan_tanaman`                 
                GROUP BY month(tgl_pesan)");
                while ($data = $sql->fetch_assoc()) {

                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['bulan']; ?></td>
                    <td>
                        <a href="?page=data_penjualan&kode=<?php echo $data['bulan']; ?>" title="Detail"
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
