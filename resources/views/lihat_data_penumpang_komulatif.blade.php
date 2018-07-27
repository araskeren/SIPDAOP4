@extends('template.master')

@section('judulhalaman','Pendapatan Harian Penumpang')
@section('judulpage')
  <h1>Pendapatan Harian Penumpang <small>{{tanggal_indo($tanggal,true)}}</small></h1>
@endsection
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <!-- DataTables -->
 <link rel="stylesheet" href="{!!asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')!!}">
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <?php
  $jumlah_pendapatan=0;
  $jumlah_volume=0;
    if(count($data_penumpang)>0){
      foreach ($data_penumpang as $i) {
        $jumlah_volume+=$i->volume;
        $jumlah_pendapatan+=$i->pendapatan;
      }
    }

  $jumlah_komulatif_volume=0;
  $jumlah_komulatif_pendapatan=0;
    if(count($data_komulatif_penumpang)>0){
      foreach ($data_komulatif_penumpang as $i) {
        $jumlah_komulatif_volume+=$i->volume;
        $jumlah_komulatif_pendapatan+=$i->pendapatan;
      }
    }
  $target_volume=0;
  $target_pendapatan=0;
    if(count($target_penumpang)>0){
      foreach ($target_penumpang as $i) {
        $target_volume+=$i->volume;
        $target_pendapatan+=$i->pendapatan;
      }
    }

   ?>
   <div class="col-lg-12">
     <div class="box box-default color-palette-box">
       <div class="box-header with-border">
         <form action="" method="post">
           <div class="col-lg-4">
             <div class="input-group date">
               <div class="input-group-addon">
               <i class="fa fa-calendar"></i>
             </div>
             <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" value="{{format_tanggal($tanggal)}}">
             </div>
           </div>
           {{csrf_field()}}
           <div class="col-lg-2">
             <input type="submit" class="btn btn-block btn-primary" value="Pilih">
           </div>
         </form>
           <div class="col-sm-2">
             <form class="" action="/penumpang/lihat/edit" method="post">
               {{csrf_field()}}
               <input type="hidden" name="tanggal" value="{{$tanggal}}">
               @if(Auth::user()->level==1||Auth::user()->level==2)
               <button type="submit" class="btn btn-block btn-success"value="edit">Edit</button>
               @endif
             </form>
           </div>
       </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title">Pendapatan Penumpang</h3>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">

            @if(count($data_komulatif_penumpang)>0)
            <tbody>
              <tr>
               <th>Jenis</th>
                <td align=right><b>Hari Ini</b></td>
                <td align=right><b>Komulatif Pendapatan</b></td>
                <td align=right><b>Target Pendapatan</b></td>
                <td align=center><b>Persentase</b></td>
              <tr>
                <td>Eksekutif</td>
                <td align=right>Rp.{{number_format($data_penumpang[0]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($data_komulatif_penumpang[0]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($target_penumpang[0]->pendapatan,2,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[0]->pendapatan,$target_penumpang[0]->pendapatan),2,',','.')}} %</td>
              </tr>
              <tr>
                <td >Bisnis</td>
                <td align=right>Rp.{{number_format($data_penumpang[1]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($data_komulatif_penumpang[1]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($target_penumpang[1]->pendapatan,2,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[1]->pendapatan,$target_penumpang[1]->pendapatan),2,',','.')}} %</td>
              </tr>
              <tr>
                <td>Ekonomi</td>
                <td align=right>Rp.{{number_format($data_penumpang[2]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($data_komulatif_penumpang[2]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($target_penumpang[2]->pendapatan,2,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[2]->pendapatan,$target_penumpang[2]->pendapatan),2,',','.')}} %</td>
              </tr>
              <tr>
                <td>Lokal</td>
                <td align=right>Rp.{{number_format($data_penumpang[3]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($data_komulatif_penumpang[3]->pendapatan,2,',','.')}}</td>
                <td align=right>Rp.{{number_format($target_penumpang[3]->pendapatan,2,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[3]->pendapatan,$target_penumpang[3]->pendapatan),2,',','.')}} %</td>
              </tr>
              <tr>
                <th>Total</th>
                <td align=right><b>Rp.{{number_format($jumlah_pendapatan,2,',','.')}}</b></td>
                <td align=right><b>Rp.{{number_format($jumlah_komulatif_pendapatan,2,',','.')}}</b></td>
                <td align=right><b>Rp.{{number_format($target_pendapatan,2,',','.')}}</b></td>
                <td align=center><b>{{number_format(persentase($jumlah_komulatif_pendapatan,$target_pendapatan),2,',','.')}} %</b></td>
              </tr>
            </tbody>
            @else
              <tbody>
                <tr>
                  Data Komulatif Tidak ada.
                </tr>
              </tbody>
            @endif
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title">Volume Penumpang</h3>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            @if(count($data_komulatif_penumpang)>0)
            <tbody>
              <tr>
                <th>Jenis</th>
                <td align=right><b>Hari Ini</b></td>
                <td align=right><b>Komulatif Volume</b></td>
                <td align=right><b>Target Volume</b> </td>
                <td align=center><b>Persentase</b> </td>
              </tr>
              <tr>
                <td>Eksekutif</td>
                <td align=right>{{number_format($data_penumpang[0]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($data_komulatif_penumpang[0]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($target_penumpang[0]->volume,0,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[0]->volume,$target_penumpang[0]->volume),2,',','.')}} %</td>
              </tr>
              <tr>
                <td>Bisnis</td>
                <td align=right>{{number_format($data_penumpang[1]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($data_komulatif_penumpang[1]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($target_penumpang[1]->volume,0,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[1]->volume,$target_penumpang[1]->volume),2,',','.')}} %</td>
              </tr>
              <tr>
                <td>Ekonomi</td>
                <td align=right>{{number_format($data_penumpang[2]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($data_komulatif_penumpang[2]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($target_penumpang[2]->volume,0,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[2]->volume,$target_penumpang[2]->volume),2,',','.')}} %</td>
              </tr>
              <tr>
                <td>Lokal</td>
                <td align=right>{{number_format($data_penumpang[3]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($data_komulatif_penumpang[3]->volume,0,',','.')}}</td>
                <td align=right>{{number_format($target_penumpang[3]->volume,0,',','.')}}</td>
                <td align=center>{{number_format(persentase($data_komulatif_penumpang[3]->volume,$target_penumpang[3]->volume),2,',','.')}} %</td>
              </tr>
              <!-- Jumlah -->
              <tr>
                <th>Total</th>
                <td align=right><b>{{number_format($jumlah_volume,0,',','.')}}</b></td>
                <td align=right><b>{{number_format($jumlah_komulatif_volume,0,',','.')}}</b></td>
                <td align=right><b>{{number_format($target_volume,0,',','.')}}</b></td>
               <td align=center><b>{{number_format(persentase($jumlah_komulatif_volume,$target_volume),2,',','.')}} %</b></td>
              </tr>
            </tbody>
            @else
            <tbody>
              Data Komulatif Tidak ada.
            </tbody>
            @endif
          </table>
        </div>
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
 <!-- DataTables -->
 <script src="{!!asset('bower_components/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
 <script src="{!!asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}"></script>
 <!-- bootstrap datepicker -->
 <script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>

 <script>
  $(function () {
    $('#data-penumpang').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'scrollY'     : '270px',
      'scrollCollapse': true,
    })

  });
  $(document).ready(function () {
      $('#datepicker').datepicker({
        locale: 'id',
        autoclose:true,
        format:'dd-mm-yyyy'
      });
  });
  </script>

@endsection
