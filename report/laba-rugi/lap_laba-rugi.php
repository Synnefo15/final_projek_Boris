<div class=" card card-secondary">
    <div class=" card-header">

        <h5 style="font-size: 20px;">
            <i class=" fa fa-table"></i>Laporan Laba-rugi
        </h5>
    </div>


    <div class=" card-body">

        <table id="example1" class="table table-bordered table-striped m-2">
            <thead>
                <tr>
                    <th style="width: 15px;">No</th>
                    <th style="width: 130px;">Bulan</th>
                    <th style="width: 30px;">Detail Laporan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = $koneksi->query("SELECT DISTINCT monthname(tgl) as nama_bulan 
                FROM jurnal order by month(tgl) asc
                ");
                while ($data = $sql->fetch_assoc()) {

                ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['nama_bulan']; ?></td>
                    <td>
                        <a href="?page=laba-rugi_view&bulan=<?php echo $data['nama_bulan']; ?>" title="Detail"
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
