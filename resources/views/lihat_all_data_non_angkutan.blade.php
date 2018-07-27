@extends('template.master')

@section('judulhalaman','Data Non Angkutan')
@section('judulpage')
<h1>Data Pemasukan Non Angkutan<small>{{tanggal_indo($tanggal,true)}}</small></h1>
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
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
            <div class="col-lg-4">
              <form class="" action="harian" method="post">
                {{csrf_field()}}
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
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data-penumpang" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Pendapatan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Pendapatan PDDM</td>
                  <td>Rp.{{number_format($total_pendapatan_pa,2,',','.')}}</td>
                  <form class="" action="cektombolpa" method="post">
                    <td>
                    <input type="hidden" name="tanggal" value="{{$tanggal}}">
                    @if(Auth::user()->level==1||Auth::user()->level==4)
                    {{csrf_field()}}
                    <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                    <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                    @endif
                  </form>
                  </td>
                </tr>
                <tr>
                <td>2</td>
                <td>Pendapatan Lawang Sewu</td>
                <td>Rp.{{number_format($total_pendapatan_lawang,2,',','.')}}</td>
                <td>
                  <form class="" action="cektombollawang" method="post">
                      {{csrf_field()}}
                      <input type="hidden" name="tanggal" value="{{$tanggal}}">
                      <button type="submit" class="btn-info" name="lihat" value="1">Lihat</button>
                      @if(Auth::user()->level==1||Auth::user()->level==5||Auth::user()->level==4)
                      <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                      <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                      @endif
                    </form>
                </td>
              </tr>
                <tr>
                  <td>3</td>
                  <td>Pendapatan Ambarawa</td>
                  <td>Rp.{{number_format($total_pendapatan_ambarawa,2,',','.')}}</td>
                  <td>
                    <form class="" action="cektombolambarawa" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="tanggal" value="{{$tanggal}}">
                    <button type="submit" class="btn-info" name="lihat" value="1">Lihat</button>
                    @if(Auth::user()->level==1||Auth::user()->level==6||Auth::user()->level==4)
                    <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                    <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                    @endif
                  </form>
                  </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Pendapatan UUK</td>
                  <td>Rp.{{number_format($total_pendapatan_uuk,2,',','.')}}</td>
                  <form class="" action="cektomboluuk" method="post">
                    <td>
                    <input type="hidden" name="tanggal" value="{{$tanggal}}">
                    @if(Auth::user()->level==1||Auth::user()->level==7)
                    {{csrf_field()}}
                    <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                    <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                    @endif
                  </form>
                  </td>
                </tr>
              </tbody>
              <tfoot>
              <tr>
                <th></th>
                <th>Total</th>
                <td>Rp.{{number_format($total,2,',','.')}}</td>
                <th>
                  <form class="" action="/nonangkutan/lihat/komulatif" method="post">
                    {{csrf_field()}}
                      <input type="hidden" name="tanggal" value="{{$tanggal}}">
                      <button type="submit" class="btn-info" name="lihat">Lihat Lebih Lanjut</button></a>
                  </form>

                </th>
              </tr>
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
 <!-- Select2 -->
 <script src="{!!asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>
 <!-- InputMask -->
 <script src="{!!asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')!!}"></script>
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
         format:'dd-mm-yyyy',
       });
   });
 </script>
@endsection
