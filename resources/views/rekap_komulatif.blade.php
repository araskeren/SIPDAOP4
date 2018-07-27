@extends('template.master')

@section('judulhalaman','Rekap Keseluruhan Komulatif')
@section('judulpage')
<h1>
  Informasi Rekapitulasi Komulatif
  <small>{{tanggal_indo($tanggal,true)}} </small>
</h1>
@endsection
@section('tambahan_judul')
<form action="export/komulatif" method="post">
  {{csrf_field()}}
  <input type="hidden" name="tanggal" value="{{$tanggal}}">
  <button type="submit" class="btn btn-block btn-success">Export Ke Excel</button>
</form>
@endsection
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
@endsection
@section('konten')
  <!-- Tempatnya Konten -->

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

  <div class="row">
    <div class="col-lg-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Laporan Pendapatan</h3>
          <div class="box-tools">
            <form class="" action="harian" method="post">
              {{csrf_field()}}
              <input type="hidden" name="tanggal" value="{{$tanggal}}">
              <button type="submit" class="btn btn-block btn-success">Detail</button>
            </form>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Jenis</th>
              <th>Pendapatan</th>
            </tr>
            <tr>
              <td>1.</td>
              <td>Penumpang</td>
              <td align=right>Rp.{{number_format($data_penumpang,2,',','.')}}</td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Barang</td>
              <td align=right>Rp.{{number_format($data_barang,2,',','.')}}</td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Non Angkutan</td>
              <td align=right>Rp.{{number_format($data_nonangkutan,2,',','.')}}</td>
            </tr>
          </tbody>

          <tfoot>
            <tr>
              <th></th>
              <th>Total</th>
              <td align=right><b>Rp.{{number_format($total_pendapatan,2,',','.')}}</b></td>
            </tr>
          </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-lg-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Progress Komulatif</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Komulatif</b></td>
              <td align=right><b>Target Tahun {{$tahun}}</b></td>
              <td align=right><b>Progress</b></td>
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
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <div>
    <h3>
      <b>
      Informasi Rincian Keseluruhan Bagian Komulatif
    </b>
  </h3>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Pendapatan Penumpang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Komulatif</b></td>
              <td align=right><b>Target Tahun {{$tahun}}</b></td>
              <td align=right><b>Progress</b></td>
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
                @endif
            </tr>
            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right><b>Rp.{{number_format($jumlah_komulatif_pendapatan_penumpang,2,',','.')}} </b></td>
              <td align=right><b>Rp.{{number_format($total_target_penumpang,2,',','.')}}</b></td>
              <td align=right><b><span class="badge bg-red">{{number_format(persentase($jumlah_komulatif_pendapatan_penumpang,$total_target_penumpang),'2','.',',')}} %</span> </b></td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Volume Penumpang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Komulatif</b></td>
              <td align=right><b>Target Tahun {{$tahun}}</b></td>
              <td align=right><b>Progress</b></td>
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
              @endif
            </tr>

            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_penumpang)>0)
              <td align=right><b>{{number_format($jumlah_komulatif_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b>{{number_format($target_volume_penumpang,0,',','.')}} Orang</b></td>
              <td align=right><b><span class="badge bg-red">{{number_format(persentase($jumlah_komulatif_volume_penumpang,$target_volume_penumpang),'2','.',',')}} %</span></b></td>
              @else
              <td  align=right>Rp.{{number_format($data_komulatif_barang[2]->pendapatan,2,',','.')}}</td>
              <td  align=right>Tidak ada Data!</td>
              @endif
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Pendapatan Barang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Komulatif</b></td>
            </tr>
            <tr>
              <td>1</td>
              <td>Petikemas</td>
              @if(count($data_komulatif_barang)>0)
              <td  align=right>Rp.{{number_format($data_komulatif_barang[2]->pendapatan,2,',','.')}}</td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>2</td>
              <td>Semen</td>
              @if(count($data_komulatif_barang)>0)
              <td  align=right>Rp.{{number_format($data_komulatif_barang[1]->pendapatan,2,',','.')}}</td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>3</td>
              <td>BBM</td>
              @if(count($data_komulatif_barang)>0)
              <td  align=right>Rp.{{number_format($data_komulatif_barang[0]->pendapatan,2,',','.')}}</td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>4</td>
              <td>Cargo</td>
              @if(count($data_komulatif_barang)>0)
              <td  align=right>Rp.{{number_format($data_komulatif_barang[3]->pendapatan,2,',','.')}}</td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>5</td>
              <td>KA lain</td>
              @if(count($data_komulatif_barang)>0)
              <td  align=right>Rp.{{number_format($data_komulatif_barang[4]->pendapatan,2,',','.')}}</td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <td>6</td>
              <td>Pendapatan Sharing</td>
              @if(count($data_komulatif_barang)>0)
              <td  align=right>Rp.{{number_format($data_komulatif_barang[5]->pendapatan,2,',','.')}}</td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
              <th>#</th>
              <th>Total</th>
              @if(count($data_komulatif_barang)>0)
              <td  align=right><b>Rp.{{number_format($jumlah_komulatif_pendapatan_barang,2,',','.')}}</b></td>
              @else
              <td  align=right>Tidak ada Data !</td>
              @endif
            </tr>

            <tr>
                <th>#</th>
                <th>Target Tahun {{$tahun}}</th>
                @if(count($data_komulatif_barang)>0)
                <td align=right> <b>Rp.{{number_format($target_barang->pendapatan,2,',','.')}} </b></td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>

            <tr>
                 <td>#</td>
                 <td><b>Progress</b></td>
                  @if(count($data_komulatif_barang)>0)
                 <td align=right><span class="badge bg-red">{{number_format(persentase($jumlah_komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
                 @else
                 <td align=right>Tidak ada Data !</td>
                 @endif
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>

    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pendukung Laporan Barang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Komulatif</b></td>
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
              <td align=right >{{number_format($data_komulatif_barang[1]->volume,0,',','.')}} (Ton)</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>2</td>
              <td>Petikemas</td>
              @if(count($data_komulatif_barang)>0)
              <td align=right >{{number_format($data_komulatif_barang[2]->volume,0,',','.')}} (Ton)</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
            <tr>
              <td>3</td>
              <td>BHP</td>

              @if($data_komulatif_bhp!=null)
              <td align=right>{{number_format($data_komulatif_bhp->value,0,',','.')}} (Kg)</td>
              @else
              <td align=right>Tidak ada Data !</td>
              @endif
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Pendapatan Non Angkutan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Komulatif</b></td>
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
                <td align=right><b>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}} </b></td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>

            <tr>
               <td>#</td>
                <td><b>Progress</b></td>
                @if(count($data_komulatif_nonangkutan)>0)
                <td align=right><b><span class="badge bg-red">{{number_format(persentase($jumlah_komulatif_pendapatan_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></b></td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>

@endsection

@section('scripttambahan')
<!--
  Tempatnya Script tambahan
  Formatnya :
  <script src="{!! asset('path') !!}"></script>
 -->

@endsection
