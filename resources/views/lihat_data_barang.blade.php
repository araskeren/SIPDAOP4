@extends('template.master')

@section('judulhalaman','Pendapatan Harian Barang')
@section('judulpage')
  <h1>Pendapatan Harian Barang <small>{{tanggal_indo($tanggal,true)}}</small></h1>
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

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="row">
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
             <form class="" action="/barang/lihat/edit" method="post">
               {{csrf_field()}}
               <input type="hidden" name="tanggal" value="{{$tanggal}}">
               @if(Auth::user()->level==1||Auth::user()->level==3)
               <button type="submit" class="btn btn-block btn-success"value="edit">Edit</button>
               @endif
             </form>
           </div>
           </form>
         </div>

 <div class="row">
   <div class="col-lg-6">
     <div class="box box-default color-palette-box">
       <div class="box-header with-border">
         <h3 class="box-title">Pendapatan Barang</h3>
       </div>
       <div class="box-body table-responsive no-padding">
         <table class="table table-hover">
           <tbody>
             <tr>
               <th>Jenis</th>
               <td align=right><b>Hari Ini</b></td>
             </tr>
             @if(count($data_barang)>0)
             <tr>
               <td>Petikemas</td>
               <td align=right>Rp.{{number_format($data_barang[0]->pendapatan,2,',','.')}}</td>
             </tr>
             <tr>
               <td>Semen</td>
               <td align=right>Rp.{{number_format($data_barang[1]->pendapatan,2,',','.')}}</td>
             </tr>
             <tr>
               <td>BBM</td>
               <td align=right>Rp.{{number_format($data_barang[2]->pendapatan,2,',','.')}}</td>
             </tr>
             <tr>
               <td>Cargo</td>
               <td align=right>Rp.{{number_format($data_barang[3]->pendapatan,2,',','.')}}</td>
             </tr>
             <tr>
               <td>KA Lain</td>
               <td align=right>Rp.{{number_format($data_barang[4]->pendapatan,2,',','.')}}</td>
             </tr>
             <tr>
               <td>Sharing</td>
               <td align=right>Rp.{{number_format($data_barang[5]->pendapatan,2,',','.')}}</td>
             </tr>
               <?php
               $jumlah_pendapatan_sekarang=0;
               $jumlah_pendapatan_komulatif=0;
                foreach($data_barang as $data) {
                  if($data->pendapatan!=null){
                    $jumlah_pendapatan_sekarang+=$data->pendapatan;
                  }
                }
                foreach($data_komulatif_barang as $data) {
                  if($data->pendapatan!=null){
                    $jumlah_pendapatan_komulatif+=$data->pendapatan;
                  }
                }
               ?>
             <tr>
               <th>Jumlah</th>
               <td align=right><b>Rp.{{number_format($jumlah_pendapatan_sekarang,2,',','.')}}</b></td>
             </tr>
             <tr>
               <th>Komulatif</th>
               <td align=right><b>Rp.{{number_format($jumlah_pendapatan_komulatif,2,',','.')}}</b></td>
             </tr>
             <tr>
               <th>Target</th>
               <td align=right><b>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</b></td>
             </tr>
             <tr>
               <th>Persentase</th>
               <td align=right><span class="badge bg-red">{{number_format(persentase($jumlah_pendapatan_komulatif,$target_barang->pendapatan),2,'.',',')}} %</span></td>
             </tr>
             @else
             <tr>
               <td>Data Pendapatan Barang Tidak Ada.</td>
             </tr>
             @endif
           </tbody>
         </table>
       </div>
     </div>
   </div>
   <div class="col-lg-6">
     <div class="box box-default color-palette-box">
       <div class="box-header with-border">
         <h3 class="box-title">Volume Barang</h3>
       </div>
       <div class="box-body table-responsive no-padding">
         <table class="table table-hover">
           <tbody>
             <tr>
               <th>Jenis</th>
               <td align=right><b>Hari Ini</b></td>
             </tr>
             @if(count($data_barang)>0)
             <tr>
               <td>Petikemas</td>
               <td align=right>{{number_format($data_barang[0]->volume,0,',','.')}}</td>
             </tr>
             <tr>
               <td>Semen</td>
               <td align=right>{{number_format($data_barang[1]->volume,0,',','.')}}</td>
             </tr>
             <tr>
               <td>BBM</td>
               <td align=right>{{number_format($data_barang[2]->volume,0,',','.')}}</td>
             </tr>
             <tr>
               <td>Cargo</td>
               <td align=right>{{number_format($data_barang[3]->volume,0,',','.')}}</td>
             </tr>
             <tr>
               <td>KA Lain</td>
               <td align=right>{{number_format($data_barang[4]->volume,0,',','.')}}</td>
             </tr>
               <?php
               $jumlah_volume_sekarang=0;
               $jumlah_volume_komulatif=0;
                foreach($data_barang as $data) {
                  if($data->pendapatan!=null){
                    if($data->volume!=null){
                      $jumlah_volume_sekarang+=$data->volume;
                    }
                  }
                }
                foreach($data_komulatif_barang as $data) {
                  if($data->pendapatan!=null){
                    if($data->volume!=null){
                      $jumlah_volume_komulatif+=$data->volume;
                    }
                  }
                }
               ?>
             <tr>
               <th >Jumlah</th>
               <td align=right><b>{{number_format($jumlah_volume_sekarang,0,',','.')}}</b></td>
             </tr>
             <tr>
               <th>Komulatif</th>
               <td align=right><b>{{number_format($jumlah_volume_komulatif,0,',','.')}}</b></td>
             </tr>
             @else
             <tr>
               <td>Data Pendapatan Barang Tidak Ada.</td>
             </tr>
             @endif
           </tbody>
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

 <!-- Select2 -->
 <script src="{!!asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>

 <!-- bootstrap datepicker -->
 <script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>

 <!-- DataTables -->
 <script src="{!!asset('bower_components/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
 <script src="{!!asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}"></script>

 <!-- page script -->
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
         format:'dd-mm-yyyy'
       });
   });
 </script>
@endsection
