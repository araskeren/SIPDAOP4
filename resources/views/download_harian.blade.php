<?php
$nama_file=tanggal_indo($tanggal,true);
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Laporan_Pendapatan_Harian_Daop_4_'$nama_file.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
  <!-- untuk menghitung laporan pendapatan -->
  <!--**Penumpang**-->


  @php($komulatif_volume_penumpang=0)
  @php($komulatif_pendapatan_penumpang=0)
  @php($target_volume_penumpang=0)
  @php($target_pendapatan_penumpang=0)
  @if(count($target_penumpang)>0)
    @foreach($target_penumpang as $i)
      @php($target_volume_penumpang+=$i->volume)
      @php($target_pendapatan_penumpang+=$i->pendapatan)
    @endforeach
  @endif
  <?php
  $jumlah_volume_penumpang=0;
  $jumlah_pendapatan_penumpang=0;
  ?>
  @if(count($data_penumpang)>0)

  @foreach($data_penumpang as $dp)
    <?php
      $jumlah_pendapatan_penumpang+=$dp->pendapatan;
      $jumlah_volume_penumpang+=$dp->volume;
     ?>
  @endforeach
  @foreach($data_komulatif_penumpang as $cp)
  <?php
    $komulatif_pendapatan_penumpang+=$cp->pendapatan;
    $komulatif_volume_penumpang+=$cp->volume;
  ?>
  @endforeach
  @endif
  <!--**Barang***-->
  @php($komulatif_pendapatan_barang=0)
  @php($komulatif_volume_barang=0)
  <?php
  $jumlah_volume_barang=0;
  $jumlah_pendapatan_barang=0;
  ?>
  @if(count($data_barang)>0)

  @foreach($data_barang as $db)
    <?php
        $jumlah_pendapatan_barang+=$db->pendapatan;
        $jumlah_volume_barang+=$db->volume;
     ?>
  @endforeach
  @foreach($data_komulatif_barang as $cb)
  <?php
    $komulatif_pendapatan_barang+=$cb->pendapatan;
    $komulatif_volume_barang+=$cb->volume;
  ?>
  @endforeach
  @endif
  <!--**Non angkutan**-->
  @php($jumlah_pendapatan_nonangkutan=0)
  @php($komulatif_nonangkutan=0)

  @if($data_nonangkutan!=null)
  @foreach($data_nonangkutan as $i)
  @php($jumlah_pendapatan_nonangkutan+=$i)
  @endforeach
  @endif

  @if(count($data_komulatif_nonangkutan)>0)
  @foreach($data_komulatif_nonangkutan as $ca)
  <?php
    $komulatif_nonangkutan+=$ca->pendapatan;
  ?>
  @endforeach
  @endif
   <b>Selamat Pagi,</b><br>
   <b>{{tanggal_indo($hariini,true)}}</b><br>
   <b>Kami Laporkan Kinerja Harian Daop 4 SM</b><br>
   <b>{{tanggal_indo($tanggal,true)}}</b>
   <h3>Laporan Pendapatan</h3>
        <table border="1">
          <tbody>
          <tr>
            <th>#</th>
            <th>Jenis</th>
            <th>Pendapatan</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Penumpang</td>
          @if(count($data_penumpang)>0)
            <td align=right>Rp.{{number_format($jumlah_pendapatan_penumpang,2,',','.')}}</td>
          @else
          <td align=right>Tidak ada data</td>
          @endif
         </tr>

          <tr>
            <td>2</td>
            <td>Barang</td>
          @if(count($data_barang)>0)
            <td align=right>Rp.{{number_format($jumlah_pendapatan_barang,2,',','.')}}</td>
          @else
            <td align=right>Tidak ada data</td>
          @endif
         </tr>

          <tr>
            <td>3</td>
            <td>Non Angkutan</td>
          @if($data_nonangkutan!=null)
            <td align=right>Rp.{{number_format($jumlah_pendapatan_nonangkutan,2,',','.')}}</td>
          @else
            <td align=right>Tidak ada data</td>
          @endif
        </tr>
        </tbody>
        <tfoot>
          @if(count($data_penumpang)>0)
          <tr>
            <th>#</th>
            <th>Total</th>
            <td align=right><b>Rp.{{number_format($jumlah_pendapatan_penumpang+$jumlah_pendapatan_barang+$jumlah_pendapatan_nonangkutan,2,',','.')}}</b></td>
          </tr>
          @endif
        </tfoot>
        </table>

    <h3>Progress Komulatif</h3>
      <table border="1">
          <tr>
            <th>#</th>
            <th>Jenis</th>
            <th>Komulatif</th>
            <th>Target Tahun {{$tahun}}</th>
            <th>Persentase</th>
          </tr>

          <tr>
            <td>1</td>
            <td>Penumpang</td>
            @if($komulatif_pendapatan_penumpang>0)
            <td align=right>Rp.{{number_format($komulatif_pendapatan_penumpang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_pendapatan_penumpang,2,',','.')}}</td>
            <td align=right>{{number_format(persentase($komulatif_pendapatan_penumpang,$target_pendapatan_penumpang),'2','.',',')}} %</td>
            @else
            <td align=right>Tidak ada data</td>
            <td align=right>Tidak ada data</td>
            <td align=right>Tidak ada data</td>
            @endif
          </tr>
          <tr>
            <td>2</td>
            <td>Barang</td>
            @if($komulatif_pendapatan_barang>0)
            <td align=right>Rp.{{number_format($komulatif_pendapatan_barang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
            @else
            <td align=right>Tidak ada data</td>
            <td align=right>Tidak ada data</td>
            <td align=right>Tidak ada data</td>
            @endif
          </tr>
          <tr>
            <td>3</td>
            <td>Non_Angkutan</td>
            @if($komulatif_nonangkutan>0)
            <td align=right>Rp.{{number_format($komulatif_nonangkutan,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($komulatif_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></td>
            @else
            <td align=right>Tidak ada data</td>
            <td align=right>Tidak ada data</td>
            <td align=right>Tidak ada data</td>
            @endif
          </tr>
          @if($komulatif_pendapatan_penumpang>0)
          <tr>
            <th>#</th>
            <th>Total</th>
            @php($total_komulatif=$komulatif_pendapatan_barang+$komulatif_pendapatan_penumpang+$komulatif_nonangkutan)
            <td align=right><b>Rp.{{number_format($total_komulatif,2,',','.')}}</b></td>
            @php($total_target=$target_pendapatan_penumpang+$target_barang->pendapatan+$target_nonangkutan->pendapatan)
            <td align=right><b>Rp.{{number_format($total_target,2,',','.')}}</b></td>
            <td align=right> <b><span class="badge bg-red">{{number_format(persentase($total_komulatif,$total_target),'2','.',',')}} %</span></b></td>
          </tr>
          @else
          <th>#</th>
          <th>Total</th>
          <td align=right><b>Tidak ada data</b></th>
          <td align=right><b>Tidak ada data</b></td>
          <td align=right><b>Tidak ada data</b></td>
          @endif
        </table>
    <h2><u>Informasi Rincian Pendapatan Harian</u></h2>
    <h3>Rincian Pendapatan Penumpang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Pendapatan</th>
              <th>Komulatif</th>
              <th>Target {{$tahun}}</th>
              <th>Persentase</th>
            </tr>
            @if(count($data_penumpang)>0)
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              <td align=right>Rp.{{number_format($data_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[0]->pendapatan,$target_penumpang[0]->pendapatan),'2','.',',')}} %</span></td>
            </tr>

            <tr>
              <td>2</td>
              <td>Bisnis</td>
              <td align=right>Rp.{{number_format($data_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[1]->pendapatan,$target_penumpang[1]->pendapatan),'2','.',',')}} %</span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              <td align=right>Rp.{{number_format($data_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[2]->pendapatan,$target_penumpang[2]->pendapatan),'2','.',',')}} %</span></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Lokal</td>
              <td align=right>Rp.{{number_format($data_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[3]->pendapatan,$target_penumpang[3]->pendapatan),'2','.',',')}} %</span></td>
            </tr>
            @else
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>Rp.{{number_format($jumlah_pendapatan_penumpang,2,',','.')}}</b></td>
              <td align=right>Rp.{{number_format($komulatif_pendapatan_penumpang,2,',','.')}} </b></td>
              <td align=right>Rp.{{number_format($target_pendapatan_penumpang,2,',','.')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($komulatif_pendapatan_penumpang,$target_pendapatan_penumpang),'2','.',',')}} %</span></b></td>
            </tr>
          </table>
    <h3>Rincian Volume Penumpang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Volume</th>
              <th>Komulatif</th>
              <th>Target {{$tahun}}</th>
              <th>Persentase</th>
            </tr>
            @if(count($data_penumpang)>0&&count($data_komulatif_penumpang)>0)
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              <td align=right>{{number_format($data_penumpang[0]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($data_komulatif_penumpang[0]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[0]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[0]->volume,$target_penumpang[0]->volume),'2','.',',')}}%</span></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Bisnis</td>
              <td align=right>{{number_format($data_penumpang[1]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($data_komulatif_penumpang[1]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[1]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[1]->volume,$target_penumpang[1]->volume),'2','.',',')}}%</span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              <td align=right>{{number_format($data_penumpang[2]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($data_komulatif_penumpang[2]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[2]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[2]->volume,$target_penumpang[2]->volume),'2','.',',')}}%</span></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Lokal</td>
              <td align=right>{{number_format($data_penumpang[3]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($data_komulatif_penumpang[3]->volume,0,',','.')}} Orang</td>
              <td align=right>{{number_format($target_penumpang[3]->volume,0,',','.')}} Orang</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[3]->volume,$target_penumpang[3]->volume),'2','.',',')}}%</span></td>
            </tr>
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>{{number_format($jumlah_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b>{{number_format($komulatif_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b>{{number_format($target_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b>{{number_format(persentase($komulatif_volume_penumpang,$target_volume_penumpang),'2','.',',')}}%</b></td>
            </tr>
          </table>

        </div>
    <h3>Rincian Pendapatan Barang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Pendapatan</b></td>
            </tr>
            @if(count($data_barang)>0)
            <tr>
              <td>1</td>
              <td>Petikemas</td>
              <td align=right>Rp.{{number_format($data_barang[0]->pendapatan,2,',','.')}}</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Semen</td>
              <td align=right>Rp.{{number_format($data_barang[1]->pendapatan,2,',','.')}}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>BBM</td>
              <td align=right>Rp.{{number_format($data_barang[2]->pendapatan,2,',','.')}}</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Cargo</td>
              <td align=right>Rp.{{number_format($data_barang[3]->pendapatan,2,',','.')}}</td>
            </tr>
            <tr>
              <td>5</td>
              <td>KA Lain</td>
              <td align=right>Rp.{{number_format($data_barang[4]->pendapatan,2,',','.')}}</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Sharing</td>
              <td align=right>Rp.{{number_format($data_barang[5]->pendapatan,2,',','.')}}</td>
            </tr>
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>Rp.{{number_format($jumlah_pendapatan_barang,2,',','.')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Komulatif</th>
              <td align=right><b>Rp.{{number_format($komulatif_pendapatan_barang,2,',','.')}} </b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Target {{$tahun}}</th>
              <td></td>
              <td align=right><b>Rp.{{number_format($target_barang->pendapatan,'2','.',',')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Persentase</th>
              <td></td>
              <td align=right><b><span class="badge bg-blue">{{number_format(persentase($komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></b></td>
            </tr>
          </table>
    <h3>Rincian Volume Barang</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Volume</b></td>
            </tr>
            @if(count($data_barang)>0)
              <tr>
                <td>1</td>
                <td>Petikemas</td>
                <td align=right>{{number_format($data_barang[0]->volume,2,',','.')}} (Ton)</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Semen</td>
                <td align=right>{{number_format($data_barang[1]->volume,2,',','.')}} (Ton)</td>
              </tr>
              <tr>
                <td>3</td>
                <td>BBM</td>
                <td align=right>{{number_format($data_barang[2]->volume,2,',','.')}} (Liter)</td>
              </tr>
              <tr>
                <td>4</td>
                <td><b>Cargo</b></td>
                <td align=right>{{number_format($data_barang[3]->volume,2,',','.')}} (Ton)</td>
              </tr>
              <tr>
                <td>5</td>
                <td>KA Lain</td>
                <td align=right>{{number_format($data_barang[4]->volume,2,',','.')}} (Ton)</td>
              </tr>
            @endif

          </table>
    <h3>Rincian Pendapatan Non Angkutan</h3>
      <table border="1">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Pendapatan</th>
            </tr>
            @php($total_pendapatan_nonangkutan=0)
            @if($data_nonangkutan!=null)
            @foreach ($data_nonangkutan as $key => $value)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$key}}</td>
              <td align=right>Rp.{{number_format($value,2,',','.')}}</td>
              @php($total_pendapatan_nonangkutan+=$value)
            </tr>
            @endforeach
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right> <b> Rp.{{number_format($total_pendapatan_nonangkutan,2,',','.')}} </b> </td>
            </tr>
            <tr>
              <th>#</th>
              <th>Komulatif</th>
              <td align=right><b>Rp.{{number_format($komulatif_nonangkutan,2,',','.')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Target {{$tahun}}</th>
              <td align=right><b>Rp.{{number_format($target_nonangkutan->pendapatan,'2',',','.')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Persentase</th>
              <td align=right><b><span class="badge bg-blue">{{number_format(persentase($komulatif_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></b></td>
            </tr>

          </table>

@php(exit())
