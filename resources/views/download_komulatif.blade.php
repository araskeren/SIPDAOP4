<?php
$nama_file=tanggal_indo($tanggal,true);
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Laporan_Pendapatan_Komulatif_Daop_4_'$nama_file.xls");  //File name extension was wrong
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
  <h2><u>Pendapatan Komulatif Daop 4 {{tanggal_indo($tanggal,true)}}</u></h2>
  <h3>Laporan Pendapatan</h3>
    <table border="1">
      <tbody>
        <tr>
          <th>#</th>
          <th>Jenis</th>
          <th>Volume</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Penumpang</td>
          <td align=right>Rp.{{number_format($data_penumpang,2,',','.')}}</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Barang</td>
          <td align=right>Rp.{{number_format($data_barang,2,',','.')}}</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Non Angkutan</td>
          <td align=right>Rp.{{number_format($data_nonangkutan,2,',','.')}}</td>
        </tr>
      </tbody>
      <tfoot>
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>Rp.{{number_format($total_pendapatan,2,',','.')}}</b></td>
            </tr>
          </tfoot>
    </table>
  <h3>Progress Komulatif</h3>
    <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
              <th>Target Tahun {{$tahun}}</th>
              <th>Progress</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Penumpang</td>
              <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_penumpang,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($total_target_penumpang,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_penumpang,$total_target_penumpang),'2','.',',')}} %</span></td>
            </tr>

            <tr>
              <td>2</td>
              <td>Barang</td>
              <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_barang,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
            </tr>

            <tr>
              <td>3</td>
              <td>Non_Angkutan</td>
              <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_nonangkutan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></td>
            </tr>

            <tr>
              <th>#</th>
              <th>Total</th>
              @php($total_komulatif=$jumlah_komulatif_pendapatan_barang+$jumlah_komulatif_pendapatan_penumpang+$jumlah_komulatif_pendapatan_nonangkutan)
              @php($total_target=$total_target_penumpang+$target_barang->pendapatan+$target_nonangkutan->pendapatan)
              <td align=right><b>Rp.{{number_format($total_komulatif,2,',','.')}}</b></td>
              <td align=right><b>Rp.{{number_format($total_target,2,',','.')}}</b></td>
              <td align=right><b><span class="badge bg-red">{{number_format(persentase($total_komulatif,$total_target),'2','.',',')}} %</span></b></td>
            </tr>
          </table>
  <h2><u>Informasi Rincian Pendapatan Komulatif</u></h2>
  <h3 >Rincian Pendapatan Penumpang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
              <th>Target Tahun {{$tahun}}</th>
              <th>Progress</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[0]->pendapatan,$target_penumpang[0]->pendapatan),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>2</td>
              <td>Bisnis</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[1]->pendapatan,$target_penumpang[1]->pendapatan),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[2]->pendapatan,$target_penumpang[2]->pendapatan),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>4</td>
              <td>Lokal</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[3]->pendapatan,$target_penumpang[3]->pendapatan),'2','.',',')}} %</span></td>
              @else
                <td align=right>Tidak ada Data !</td>
                <td align=right>Tidak ada Data !</td>
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>
            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right><b>Rp.{{number_format($jumlah_komulatif_pendapatan_penumpang,2,',','.')}}</b></td>
              <td align=right><b>Rp.{{number_format($total_target_penumpang,2,',','.')}}</b></td>
              <td align=right><b>{{number_format(persentase($jumlah_komulatif_pendapatan_penumpang,$total_target_penumpang),'2','.',',')}} %</b></td>
              @else
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
          </table>
  <h3>Rincian Volume Penumpang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
              <th>Target Tahun {{$tahun}}</th>
              <th>Progress</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>{{number_format($data_komulatif_penumpang[0]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[0]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[0]->volume,$target_penumpang[0]->volume),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>2</td>
              <td>Bisnis</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>{{number_format($data_komulatif_penumpang[1]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[1]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[1]->volume,$target_penumpang[1]->volume),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>{{number_format($data_komulatif_penumpang[2]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[2]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[2]->volume,$target_penumpang[2]->volume),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>4</td>
              <td>Lokal</td>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right>{{number_format($data_komulatif_penumpang[3]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[3]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[3]->volume,$target_penumpang[3]->volume),'2','.',',')}} %</span></td>
              @else
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right><b>{{number_format($jumlah_komulatif_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b>{{number_format($target_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b>{{number_format(persentase($jumlah_komulatif_volume_penumpang,$target_volume_penumpang),'2','.',',')}} %</b></td>
              @else
              <td align=right>Tidak ada Data!</td>
              <td align=right>Tidak ada Data!</td>
              <td align=right>Tidak ada Data !</td>
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
          </table>
  <h3>Rincian Pendapatan Barang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Petikemas</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_barang[2]->pendapatan,2,',','.')}}</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>2</td>
              <td>Semen</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_barang[1]->pendapatan,2,',','.')}}</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>3</td>
              <td>BBM</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_barang[0]->pendapatan,2,',','.')}}</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>4</td>
              <td>Cargo</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_barang[3]->pendapatan,2,',','.')}}</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>5</td>
              <td>KA lain</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_barang[4]->pendapatan,2,',','.')}}</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>6</td>
              <td>Pendapatan Sharing</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>Rp.{{number_format($data_komulatif_barang[5]->pendapatan,2,',','.')}}</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_barang)>0)
              <th align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_barang,2,',','.')}}</th>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
                <th>#</th>
                <th>Target Tahun {{$tahun}}</th>
                @if(count($data_komulatif_barang)>0)
                <th align=right>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</th>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>

            <tr>
                 <td>#</td>
                 <th><b>Progress</b></th>
                  @if(count($data_komulatif_barang)>0)
                 <td align=right><b>{{number_format(persentase($jumlah_komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</b></td>
                 @else
                 <td align=right>Tidak ada Data !</td>
                 @endif
            </tr>
          </table>
  <h3>Pendukung Laporan Barang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
            </tr>
            <tr>
              <td>1</td>
              <td>BBM</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>{{number_format($data_komulatif_barang[0]->volume,0,',','.')}} (L)</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>2</td>
              <td>Semen</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>{{number_format($data_komulatif_barang[1]->volume,0,',','.')}} (Ton)</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>3</td>
              <td>BHP</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right>{{number_format($data_komulatif_bhp->value,0,',','.')}} (Kg)</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
          </table>
  <h3>Rincian Pendapatan Non Angkutan</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
            </tr>
            @foreach($data_komulatif_nonangkutan as $i)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$i->jenis}}</td>
                <td align=right>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
              </tr>
            @endforeach
            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_nonangkutan)>0)
              <td align=right><b>Rp.{{number_format($jumlah_komulatif_pendapatan_nonangkutan,2,',','.')}}</b></td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
               <th>#</th>
                <th>Target Tahun {{$tahun}}</th>
                @if(count($data_komulatif_nonangkutan)>0)
                <td align=right><b>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}}</b></td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>

            <tr>
               <td>#</td>
                <th>Progress</th>
                @if(count($data_komulatif_nonangkutan)>0)
                <td align=right><b>{{number_format(persentase($jumlah_komulatif_pendapatan_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</b></td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>
          </table>
