@extends('template.master')
@section('judulhalaman','Laporan Harian')
@section('judulpage')
<h1>Laporan Untuk KA Daop 4 <small>{{tanggal_indo($tanggal,true)}}</small></h1>
@endsection
@section('tambahan_judul')
<form action="export/kadaop" method="post">
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
  <div class="col-lg-8">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Pendapatan Harian DAOP 4 SM</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding " id="laporan_pendapatan">
        <table class="table table-hover">
          <tbody>
          <tr>
            <th style="width: 10px">#</th>
            <th>Jenis</th>
            <td align=right><b>Pendapatan</b></td>
            <td align=right><b>Komulatif </b></td>
            <td align=right><b>Target </b></td>
            <td align=right><b>Progress</b></td>
          </tr>
          <tr>
            <td>1.</td>
            <td>Penumpang</td>
            <td align=right>Rp.{{number_format($data_penumpang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_penumpang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($total_target_penumpang,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_penumpang,$total_target_penumpang),'2','.',',')}} %</span></td>
         </tr>

          <tr>
            <td>2.</td>
            <td>Barang</td>
            <td align=right>Rp.{{number_format($data_barang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($jumlah_komulatif_pendapatan_barang,2,',','.')}}</td>
            <td align=right>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</td>
            <td align=right><span class="badge bg-blue">{{number_format(persentase($jumlah_komulatif_pendapatan_barang,$target_barang->pendapatan),'2','.',',')}} %</span></td>
         </tr>

          <tr>
            <td>3.</td>
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
          <td align=right><span class="badge bg-red">{{number_format(persentase($total_komulatif,$total_target),'2','.',',')}} %</span></b></td>
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
