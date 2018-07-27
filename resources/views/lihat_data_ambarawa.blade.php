@extends('template.master')

@section('judulhalaman','Judul Halaman')
@section('judulpage')
<h1>Lihat Data Ambarawa<small>{{tanggal_indo($tanggal->todatestring(),true)}}</small></h1></h1>
@endsection
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <!-- Select2 -->
 <link rel="stylesheet" href="{!!asset('bower_components/select2/dist/css/select2.min.css')!!}">
 <!-- DataTables -->
 <link rel="stylesheet" href="{!!asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')!!}">
 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">

              </div>
@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="row">
     <div class="col-xs-6">
       <div class="box">
           <div class="box-header">
             <form class="" action="ambarawa" method="post">
               {{csrf_field()}}
               <div class="col-lg-6">
                 <div class="input-group date">
                   <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal">
                 </div>
               </div>
              <button type="submit" class="btn-info" name="lihat">Lihat</button>
             </form>
           </div>
   <div class="row">
     <div class="col-lg-12">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">


         </div>
         <div class="box-body table-responsive no-padding">
           <table class="table table-hover">
             <tbody>
               <tr>
                 <th colspan="2">Jenis</th>
                 <th>Volume</th>
                 <th>Pendapatan</th>
               </tr>
               @if(count($data_ambarawa)>0)
               <tr>
                 <td colspan="2">Wisatawan Lokal</td>
                   <td></td>
                   <td></td>
               </tr>
               <tr>
                 <td width=10px;></td>
                 <td colspan="1">Dewasa</td>
                 <td>{{number_format($data_ambarawa[0]->volume,0,',','.')}}</td>
                 <td>Rp.{{number_format($data_ambarawa[0]->total,2,',','.')}}</td>
               </tr>
               <tr>
                 <td width=10px;></td>
                 <td colspan="1">Anak-anak</td>
                 <td>{{number_format($data_ambarawa[1]->volume,0,',','.')}}</td>
                 <td>Rp.{{number_format($data_ambarawa[1]->total,2,',','.')}}</td>
               </tr>
               <tr>
                 <td colspan="2">Wisatawan asing</td>
               </tr>
               <tr>
                 <td width=30px;></td>
                 <td colspan="1">Dewasa</td>
                 <td>{{number_format($data_ambarawa[2]->volume,0,',','.')}}</td>
                 <td>Rp.{{number_format($data_ambarawa[2]->total,2,',','.')}}</td>
               </tr>
               <tr>
                 <td width=10px;></td>
                 <td colspan="1">Anak-anak</td>
                 <td>{{number_format($data_ambarawa[3]->volume,0,',','.')}}</td>
                 <td>Rp.{{number_format($data_ambarawa[3]->total,2,',','.')}}</td>
               </tr>
               <tr>
                   <td colspan="2">Pendapatan rts</td>
                   <td>{{number_format($data_ambarawa[4]->volume,0,',','.')}}</td>
                   <td>Rp.{{number_format($data_ambarawa[4]->total,2,',','.')}}</td>
                 </tr>
               <tr>
                   <td colspan="2">Pendapatan Ka Sewa</td>
                     <td>{{number_format($data_ambarawa[5]->volume,0,',','.')}}</td>
                   <td>Rp.{{number_format($data_ambarawa[5]->total,2,',','.')}}</td>
                 </tr>
                 <?php
                  $volume=0;
                  $pendapatan=0;
                  foreach ($data_ambarawa as $i) {
                    $volume+=$i->volume;
                    $pendapatan+=$i->total;
                  }
                 ?>
               <tr>
                 <th colspan="2">Jumlah</th>
                 <th>{{number_format($volume,0,',','.')}}</th>
                 <th>Rp.{{number_format($pendapatan,2,',','.')}}</th>
               </tr>
               @else
                <tr>
                  <td>Tidak ada data !</td>
                </tr>
               @endif
             </tbody>
           </table>
         </div>
       </div>
     </div>
@endsection

@section('scripttambahan')
<!-- bootstrap datepicker -->
<script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>
<!--
  Tempatnya Script tambahan
  Formatnya :
  <script src="{!! asset('path') !!}"></script>
 -->
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
   })
   $(document).ready(function () {
       $('#datepicker').datepicker({
         locale: 'id',
         autoclose:true,
         format:'dd-mm-yyyy',
       });
   });
 </script>

@endsection
