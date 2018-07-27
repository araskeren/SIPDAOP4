@extends('template.master')
@section('judulhalaman','Pendapatan Harian DAOP 4 SM')
@section('judulpage')
<h1>Pendapatan Harian DAOP 4 SM<small>{{tanggal_indo($tanggal,true)}} </small></h1>
@endsection
@section('tambahan_judul')
<form action="export/harian" method="post">
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
 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
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
  @endif

  @if(count($data_komulatif_penumpang)>0)
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
  @endif

  @if(count($data_komulatif_barang)>0)
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
  <div class="row">
    <form class="form-horizontal" action="" method="post">
      {{csrf_field()}}
        <div class="col-lg-5">
            <div class="col-lg-7">
        <!-- Date -->
        <div class="form-group">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Pilih Tanggal" name="tanggal">
          </div>
        </div>
      <!-- /.form group -->
      </div>
      <div class="col-xs-1">
        <button class="btn btn-info"type="submit" name="pilih">Lihat</button>
      </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-lg-4">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Laporan Pendapatan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding" id="laporan_pendapatan">
        <table class="table table-hover">
          <tbody>
          <tr>
            <th style="width: 10px">#</th>
            <th>Jenis</th>
            <th>Pendapatan</th>
          </tr>
          <tr>
            <td>1.</td>
            <td>Penumpang</td>
          @if(count($data_penumpang)>0)
            <td align=right>Rp.{{number_format($jumlah_pendapatan_penumpang,2,',','.')}}</td>
          @else
          <td align=right>Tidak ada data</td>
          @endif
         </tr>

          <tr>
            <td>2.</td>
            <td>Barang</td>
          @if(count($data_barang)>0)
            <td align=right>Rp.{{number_format($jumlah_pendapatan_barang,2,',','.')}}</td>
          @else
            <td align=right>Tidak ada data</td>
          @endif
         </tr>

          <tr>
            <td>3.</td>
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
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-lg-8">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Progress Komulatif</h3>
        <div class="box-tools">
         <!-- <form class="" action="/laporan/komulatif" method="post">
           {{csrf_field()}}
           <input type="hidden" name="tanggal" value="{{$tanggal}}">
           <button type="submit" class="btn btn-block btn-success">Selengkapnya</button>
         </form> -->
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <td width='10px'>#</td>
            <td><b>Jenis</b></td>
            <td align=right><b>Komulatif</b></td>
            <td align=right><b>Target Tahun {{$tahun}}</b></td>
            <td align=center><b>Persentase</b></td>
          </tr>
          <tr>
            <td>1</td>
            <td>Penumpang</td>
            @if($komulatif_pendapatan_penumpang>0)
            <td align=right>Rp.{{number_format($komulatif_pendapatan_penumpang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_pendapatan_penumpang,2,',','.')}}</td>
            <td align=center><span class="badge bg-blue">{{number_format(persentase($komulatif_pendapatan_penumpang,$target_pendapatan_penumpang),'2','.',',')}} %</span></td>
            @else
            <td align=right>Tidak ada Data</td>
            <td align=right>Tidak ada Data</td>
            <td align=right>Tidak ada Data</td>
            @endif

          </tr>

          <tr>
            <td>2</td>
            <td>Barang</td>
            @if($komulatif_pendapatan_barang>0)
            <td align=right>Rp.{{number_format($komulatif_pendapatan_barang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</td>
            <td align=center><span class="badge bg-blue">{{number_format(persentase($komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
            @else
            <td align=right>Tidak ada Data</td>
            <td align=right>Tidak ada Data</td>
            <td align=right>Tidak ada Data</td>
            @endif
          </tr>

          <tr>
            <td>3</td>
            <td>Non_Angkutan</td>
            @if($komulatif_nonangkutan>0)
            <td align=right>Rp.{{number_format($komulatif_nonangkutan,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}}</td>
            <td align=center><span class="badge bg-blue">{{number_format(persentase($komulatif_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></td>
            @else
            <td align=right>Tidak ada Data</td>
            <td align=right>Tidak ada Data</td>
            <td align=right>Tidak ada Data</td>
            @endif
          </tr>
          @if($komulatif_pendapatan_penumpang>0)
          <tr>
            <th>#</th>
            <th>Total</th>
            @php($total_komulatif=$komulatif_pendapatan_barang+$komulatif_pendapatan_penumpang+$komulatif_nonangkutan)
            <td align=right><b>Rp.{{number_format($total_komulatif,2,',','.')}}</b></td>
            @php($total_target=$target_pendapatan_penumpang+$target_barang->pendapatan+$target_nonangkutan->pendapatan)
            <td align=right><b>Rp.{{number_format($total_target,2,',','.')}}</b></th>
            <td align=center><b><span class="badge bg-red">{{number_format(persentase($total_komulatif,$total_target),'2','.',',')}} %</span></b></th>
          @else
          <td align=right>#</td>
          <th align=center>Total</th>
          <td align=right>Tidak ada data</td>
          <td align=right>Tidak ada data</td>
          <td align=right>Tidak ada data</td>
          @endif
        </tr>

        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
  <div class="content-header">
    <h1>Informasi Rincian Rekapitulasi Harian</h1>
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
              <td align=right><b>Pendapatan</b></td>
              <td align=right><b>Komulatif</b></td>
              <td align=right><b>Target {{$tahun}}</b></td>
              <td align=right><b>Persentase</b></td>
            </tr>
            @if(count($data_penumpang)>0)
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              <td align=right>Rp.{{number_format($data_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[0]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[0]->pendapatan,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[0]->pendapatan,$target_penumpang[0]->pendapatan),'2','.',',')}} %</span></td>
            </tr>

            <tr>
              <td>2</td>
              <td>Bisnis</td>
              <td align=right>Rp.{{number_format($data_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[1]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[1]->pendapatan,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[1]->pendapatan,$target_penumpang[1]->pendapatan),'2','.',',')}} %</span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              <td align=right>Rp.{{number_format($data_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[2]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[2]->pendapatan,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[2]->pendapatan,$target_penumpang[2]->pendapatan),'2','.',',')}} %</span></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Lokal</td>
              <td align=right>Rp.{{number_format($data_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($data_komulatif_penumpang[3]->pendapatan,2,',','.')}}</td>
              <td align=right>Rp.{{number_format($target_penumpang[3]->pendapatan,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[3]->pendapatan,$target_penumpang[3]->pendapatan),'2','.',',')}} %</span></td>
            </tr>
            @else
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>Rp.{{number_format($jumlah_pendapatan_penumpang,2,',','.')}}</b></td>
              <td align=right><b>Rp.{{number_format($komulatif_pendapatan_penumpang,2,',','.')}}</b></td>
              <td align=right><b>Rp.{{number_format($target_pendapatan_penumpang,'2','.',',')}}</b></td>
              <td align=right><b><span class="badge bg-red">{{number_format(persentase($komulatif_pendapatan_penumpang,$target_pendapatan_penumpang),'2','.',',')}} %</span></b></td>
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
              <td align=right><b>Volume</b></td>
              <td align=right><b>Komulatif</b></td>
              <td align=right><b>Target {{$tahun}}</b></td>
              <td align=right><b>Persentase</b></td>
            </tr>
            @if(count($data_penumpang)>0&&count($data_komulatif_penumpang)>0)
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              <td align=right>{{number_format($data_penumpang[0]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($data_komulatif_penumpang[0]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($target_penumpang[0]->volume,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[0]->volume,$target_penumpang[0]->volume),'2','.',',')}}%</span></td>
            </tr>
            <tr>
              <td>2</td>
              <td>Bisnis</td>
              <td align=right>{{number_format($data_penumpang[1]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($data_komulatif_penumpang[1]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($target_penumpang[1]->volume,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[1]->volume,$target_penumpang[1]->volume),'2','.',',')}}%</span></td>
            </tr>
            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              <td align=right>{{number_format($data_penumpang[2]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($data_komulatif_penumpang[2]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($target_penumpang[2]->volume,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[2]->volume,$target_penumpang[2]->volume),'2','.',',')}}%</span></td>
            </tr>
            <tr>
              <td>4</td>
              <td>Lokal</td>
              <td align=right>{{number_format($data_penumpang[3]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($data_komulatif_penumpang[3]->volume,0,',','.')}}</td>
              <td align=right>{{number_format($target_penumpang[3]->volume,'2','.',',')}}</td>
              <td align=right><span class="badge bg-blue">{{number_format(persentase($data_komulatif_penumpang[3]->volume,$target_penumpang[3]->volume),'2','.',',')}}%</span></td>
            </tr>
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>{{number_format($jumlah_volume_penumpang,0,',','.')}}</b></td>
              <td align=right><b>{{number_format($komulatif_volume_penumpang,0,',','.')}}</b></td>
              <td align=right><b>{{number_format($target_volume_penumpang,'2','.',',')}}</b></td>
              <td align=right><b><span class="badge bg-red">{{number_format(persentase($komulatif_volume_penumpang,$target_volume_penumpang),'2','.',',')}}%</span></b></th>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  <div class="row">
  </div>
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
              <td>Ka Lain</td>
              <td align=right>Rp.{{number_format($data_barang[4]->pendapatan,2,',','.')}}</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Sharing</td>
              <td align=right>Rp.{{number_format($data_barang[5]->pendapatan,2,',','.')}}</td>
            </tr>
            @endif
            <tr>
              <td><b>#</b></td>
              <td><b>Total</b></td>
              <td align=right><b>Rp.{{number_format($jumlah_pendapatan_barang,2,',','.')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Komulatif</th>
              <td align=right><b>Rp.{{number_format($komulatif_pendapatan_barang,2,',','.')}} </b>  </td>
            </tr>
            <tr>
              <td>#</td>
              <td><b>Target</b></td>
              <td align=right><b>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</b></td>
            </tr>
            <tr>
              <td><b>#</b></td>
              <td><b>Persentase</b></td>
              <td align=right><span class="badge bg-red"> {{number_format(persentase($komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Volume Barang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <td align=right><b>Volume</b></td>
              <td align=right><b>Komulatif</b></td>
            </tr>
            @if(count($data_barang)>0)
              <tr>
                <td>1</td>
                <td>Petikemas</td>
                @if(count($data_komulatif_barang)>0)
                <td align=right>{{number_format($data_barang[0]->volume,0,',','.')}} (Ton)</td>
                <td align=right>{{number_format($data_komulatif_barang[0]->volume,2,',','.')}} (Ton)</td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
              </tr>
              <tr>
                <td>2</td>
                <td>Semen</td>
                @if(count($data_komulatif_barang)>0)
                <td align=right>{{number_format($data_barang[2]->volume,0,',','.')}} (Ton)</td>
                <td align=right>{{number_format($data_komulatif_barang[1]->volume,2,',','.')}} (Ton)</td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
              </tr>
              <tr>
                <td>3</td>
                <td>BBM</td>
                @if(count($data_barang)>0)
                <td align=right>{{number_format($data_barang[3]->volume,0,',','.')}} (L)</td>
                <td align=right>{{number_format($data_komulatif_barang[3]->volume,2,',','.')}} (L)</td>
                @else
                <td align=right>Tidak ada Data !</td>
                @endif
              </tr>
              <tr>
                <td>4</td>
                <td>Cargo</td>
                @if(count($data_barang)>0)
                <td align=right>{{number_format($data_barang[3]->volume,0,',','.')}} (Ton)</td>
                <td align=right>{{number_format($data_komulatif_barang[3]->volume,2,',','.')}} (Ton)</td>
                @else
                <td align=right><b>Tidak ada Data !</b></td>
                @endif
              </tr>
              <tr>
                <td>5</td>
                <td>KA Lain</td>
                <td align=right>Rp.{{number_format($data_barang[4]->volume,2,',','.')}} (Ton)</td>
                <td align=right>{{number_format($data_komulatif_barang[4]->volume,2,',','.')}} (Ton)</td>
              </tr>
            @endif

          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-5">
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
              <td align=right><b>Pendapatan</b></td>
            </tr>
            @php($total_pendapatan_nonangkutan=0)
            @if($data_nonangkutan!=null)
            @foreach ($data_nonangkutan as $key => $value)
            <tr>
              <td >{{$loop->iteration}}</td>
              <td >{{$key}}</td>
              <td align=right>Rp.{{number_format($value,2,',','.')}}</td>
              @php($total_pendapatan_nonangkutan+=$value)
            </tr>
            @endforeach
            @endif
            <tr>
              <th>#</th>
              <th>Total</th>
              <td align=right><b>Rp.{{number_format($total_pendapatan_nonangkutan,2,',','.')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Komulatif</th>
              <td align=right><b>Rp.{{number_format($komulatif_nonangkutan,2,',','.')}}</b></th>
            </tr>
            <tr>
              <th>#</th>
              <th>Target</th>
              <td align=right><b>Rp.{{number_format($target_nonangkutan->pendapatan,2,',','.')}}</b></td>
            </tr>
            <tr>
              <th>#</th>
              <th>Persentase</th>
              <td align=right><span class="badge bg-red">{{number_format(persentase($komulatif_nonangkutan,$target_nonangkutan->pendapatan),'2','.',',')}} %</span></td>
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
 <!-- bootstrap datepicker -->
<script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>
<script src="{!! asset('dist/js/jquery.table2excel.js')!!}"></script>
 <script>
 $(document).ready(function () {
     $('#datepicker').datepicker({
       locale: 'id',
       autoclose:true,
       format:'dd-mm-yyyy',
     });
     $("#btn_export").click(function(){
	      $("#laporan_pendapatan").table2excel({
	         exclude: ".noExl",
    	     name: "Excel File Name"
        });
    });
 });
 </script>

@endsection
