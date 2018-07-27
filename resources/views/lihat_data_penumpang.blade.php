@extends('template.master')

@section('judulhalaman','Pendapatan Penumpang')
@section('judulpage')
<h1>Data Pendapatan Penumpang <small>{{$tanggal}}</small></h1>
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
    <form  action="detail" method="post" class="form-horizontal">
      <div class="col-lg-7">
        <div class="box box-default color-palette-box">
          <div class="box-header with-border">
            <div class="col-lg-5">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal">
              </div>
            </div>
            <div class="col-lg-4">
              <select class="form-control select2" name="stasiun_id" style="width: 100%;">
                <option selected="selected">Pilih Stasiun</option>
                @foreach($data_stasiun as $i)
                  <option value="{{$i->id}}">{{$i->nama_stasiun}}</option>
                @endforeach
              </select>
            </div>
            {{csrf_field()}}
            <div class="col-xs-2">
              <button type="submit" class="btn btn-info" name="submit">Lihat</button>
            </div>
          </div>
        </form>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">


        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th>Jenis</th>
                <th>Volume</th>
                <th>Pendapatan</th>
              </tr>
              @php($jumlah_volume=0)
              @php($jumlah_pendapatan=0)

              @foreach($data as $i)
                <tr>
                  <td>{{$i->jenis}}</td>
                  <td>{{number_format($i->volume,0,',','.')}}</td>
                 <td>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
                </tr>
                @php($jumlah_volume+=$i->volume)
                @php($jumlah_pendapatan+=$i->pendapatan)
              @endforeach

              <tr>
                <th>Jumlah</th>
                <th>{{number_format($jumlah_volume,0,',','.')}}</th>
                <th>Rp.{{number_format($jumlah_pendapatan,2,',','.')}}</th>
              </tr>
            </tbody>
          </table>
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
     $('.select2').select2()
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
