<?php
$nama_file=tanggal_indo($tanggal,true);
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Laporan_Pendapatan_KA_Daop_4_'$nama_file.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
  @php($jumlah_komulatif_volume_penumpang=0)
  @php($jumlah_komulatif_pendapatan_penumpang=0)
  @php($target_volume_penumpang=0)
  @php($target_pendapatan_penumpang=0)
  @if(count($target_penumpang)>0)
    @foreach($target_penumpang as $i)
      @php($target_volume_penumpang+=$i->volume)
      @php($target_pendapatan_penumpang+=$i->pendapatan)
    @endforeach
  @endif
  @foreach($data_komulatif_penumpang as $kp)
    <?php
      $jumlah_komulatif_volume_penumpang+=$kp->volume;
      $jumlah_komulatif_pendapatan_penumpang+=$kp->pendapatan;
     ?>
  @endforeach
  @php($jumlah_komulatif_pendapatan_barang=0)
  @php($jumlah_komulatif_volume_barang=0)
  @foreach($data_komulatif_barang as $ci)
  <?php
  $jumlah_komulatif_pendapatan_barang+=$ci->pendapatan;
  $jumlah_komulatif_volume_barang+=$ci->volume;
   ?>
  @endforeach

  <!--**komulatif non angkutan-->
  @php($jumlah_komulatif_pendapatan_nonangkutan=0)
  @foreach($data_komulatif_nonangkutan as $kn)
    <?php
      $jumlah_komulatif_pendapatan_nonangkutan+=$kn->pendapatan;
    ?>
  @endforeach
  @php($total_target_penumpang=0)
  @if(count($target_penumpang)>0)
    @foreach($target_penumpang as $i)
      @php($total_target_penumpang+=$i->pendapatan)
    @endforeach
  @endif
  <b>Selamat Pagi,</b><br>
  <b>{{tanggal_indo($hariini,true)}}</b><br>
  <b>Kami Laporkan Kinerja Harian Daop 4 SM</b><br>
  <b>{{tanggal_indo($tanggal,true)}}</b>
      <table border="1">
          <tbody>
          <tr>
            <th>#</th>
            <th>Jenis</th>
            <th>Pendapatan</th>
            <th>Komulatif</th>
            <th>Target</th>
            <th>Progress</th>
          </tr>

          <tr>
            <td>1</td>
            <td>Penumpang</td>
            <td align=right>Rp.{{number_format($data_penumpang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_penumpang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($total_target_penumpang,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_penumpang,$total_target_penumpang),'2','.',',')}} %</span></td>
         </tr>

          <tr>
            <td>2</td>
            <td>Barang</td>
            <td align=right>Rp.{{number_format($data_barang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_barang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
         </tr>

          <tr>
            <td>3</td>
            <td>NonAngkutan</td>
            <td align=right>Rp.{{number_format($data_nonangkutan,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_nonangkutan,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_barang,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></td>
        </tr>
        <tr>
          <td></td>
          <th>Total</th>
          @php($total_komulatif=$jumlah_komulatif_pendapatan_barang+$jumlah_komulatif_pendapatan_penumpang+$jumlah_komulatif_pendapatan_nonangkutan)
          @php($total_target=$total_target_penumpang+$target_barang->pendapatan+$target_nonangkutan->pendapatan)
          <td align=right><b>Rp.{{number_format($total_pendapatan,2,',','.')}}</b></td>
          <td align=right><b>Rp.{{number_format($total_komulatif,2,',','.')}}</b></td>
          <td align=right><b>Rp.{{number_format($total_target,2,',','.')}}</b></td>
          <td align=right><b><span class="badge bg-red">{{number_format(persentase($total_komulatif,$total_target),'2','.',',')}} %</span></b></td>
      </tr>
        </tbody>
        <tfoot>

        </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
