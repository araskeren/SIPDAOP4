@extends('template.master')

@section('judulhalaman','Pemasukan BHP')
@section('judulpage')
  <h1>Data Pemasukan BHP  <small>{{tanggal_indo($tanggal,true)}}</small></h1>
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
            <form class="" action="" method="post">
                {{csrf_field()}}
            <div class="col-xs-4">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal">
              </div>
            </div>
            <div class="col-xs-2">
              <button type="submit" class="btn btn-info" name="submit">Lihat</button>
            </div>
            </form>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="data-penumpang" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Stasiun</th>
                <th>Pendapatan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                @php($total_pendapatan=0)
                  @if(count($data_bhp)>0)
                  @foreach($data_bhp as $i)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$i->stasiun->nama_stasiun}}</td>
                      <td>{{number_format($i->value,0,',','.')}} (Kg)</td>
                      <td>
                        <form class="" action="cektombol" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="tanggal" value="{{$tanggal}}">
                        <input type="hidden" name="id" value="{{$i->id}}">
                        @if(Auth::user()->level==1||Auth::user()->level==3)
                        <button type="submit" class="btn-primary disable" value="1" name="edit">Edit</button>
                        <button type="submit" class="btn-danger" value="1" name="delete">Delete</button>
                        @endif
                      </form>
                      </td>
                    </tr>
                    @php($total_pendapatan+=$i->value)
                  @endforeach
                @endif
              </tbody>
              <tfoot>

                <tr>
                                <td></td>
                                <td><b>Total</b></td>
                                <td><b>{{number_format($total_pendapatan,0,',','.')}}(Kg)</b></td>
                                <td>
                                  <form class="" action="/barang/komulatif" method="post">
                                    {{csrf_field()}}
                                      <input type="hidden" name="tanggal" value="{{$tanggal}}">
                                      <button type="submit" class="btn-info" name="lihat">Lihat Lebih Lanjut</button></a>
                                  </form>
                                </td>
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
