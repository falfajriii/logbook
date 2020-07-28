<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=history-result.xls");
  include "koneksi.php";
  $query = mysqli_query($koneksi, "SELECT * FROM kunjungan");
 ?>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr style="text-align: center;">
                      <th style="background-color: #3ac5d0;">No</th>
                      <th style="background-color: #3ac5d0;">Nama Pengunjung</th>
                      <th style="background-color: #3ac5d0;">Company</th>
                      <th style="background-color: #3ac5d0;">Tanggal</th>
                      <th style="background-color: #3ac5d0;">Keterangan</th>
                      <th style="background-color: #3ac5d0;">Jam Masuk</th>
                      <th style="background-color: #3ac5d0;">Jam Keluar</th>
                      <th style="width: 100px; background-color: #3ac5d0; ">Pendamping</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $x=1; ?>
                    <?php if(mysqli_num_rows($query)) {?>
                    <?php while($row = mysqli_fetch_array($query)) {?>
                    <tr style="text-align: center;">
                      <td style="width: 30px;"><?php echo $x; ?></td>
                      <td style="width: 175px; text-align: left;"><?php echo $row['nm_kunjungan']?> </td>
                      <td style="width: 175px;"><?php echo $row['company']?> </td>
                      <td style="width: 115px;"><?php echo $row['tanggal']?> </td>
                      <td style="width: 450px; text-align: left;"><?php echo $row['keterangan']?></td>
                      <td style="width: 115px;"><?php echo $row['jam_msk']?> </td>
                      <td style="width: 115px;"><?php echo $row['jam_klr']?> </td>                     
                      <td><?= $row['pendamping']?></td>
                    </tr>
                    <?php $x++; ?>
                    <?php } ?>
                    <?php } ?>
                  </tbody>
                </table>