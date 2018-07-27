@extends('template.master')
@section('judulhalaman','Data Pemasukan Penumpang')
@section('judulpage')
  <h1>Data Pemasukan Penumpang  <small>{{tanggal_indo($tanggal,true)}}</small></h1>
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
              <div class="col-xs-4">
                <div class="input-group date">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal">
                </div>
              </div>
              {{csrf_field()}}
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
                <th>Volume</th>
                <th>Pendapatan</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php
                $total_pendapatan=0;
                $total_volume=0;
                $jumlah_volume=0;
                $jumlah_pendapatan=0;
                $stasiun=0;
                $end=count($data);
                $nomer=1;
                //dd(end($data));
              ?>
                @foreach($data as $i)

                  @if($loop->iteration==1)
                    <?php
                    $stasiun=$i->stasiun_id;
                    $jumlah_pendapatan=$i->pendapatan;
                    $jumlah_volume=$i->volume;
                     ?>
                  @elseif($stasiun!=$i->stasiun_id)
                    <?php
                      $total_volume+=$jumlah_volume;
                      $total_pendapatan+=$jumlah_pendapatan;
                     ?>
                    <tr>
                      <td>{{$nomer}}</td>
                      <td>{{$data[$loop->index-1]->stasiun->nama_stasiun}}</td>
                      <td>{{number_format($jumlah_volume,0,',','.')}}</td>
                      <td>Rp.{{number_format($jumlah_pendapatan,2,',','.')}}</td>
                      <td>
                        <form class="" action="lihat/cektombol" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="tanggal" value="{{$tanggal}}">
                        <input type="hidden" name="stasiun_id" value="{{$stasiun}}">
                        <button type="submit" class="btn-info" name="lihat" value="1">Lihat</button>
                        @if(Auth::user()->level==1||Auth::user()->level==2)
                        <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                        <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                        @endif
                      </form>
                      </td>
                    </tr>
                    <?php
                      $nomer++;
                      $stasiun=$i->stasiun_id;
                      $jumlah_pendapatan=$i->pendapatan;
                      $jumlah_volume=$i->volume;
                     ?>
                  @elseif($loop->iteration==$end)
                  <?php
                  $stasiun=$i->stasiun_id;
                  $jumlah_pendapatan+=$i->pendapatan;
                  $jumlah_volume+=$i->volume;
                  $total_volume+=$jumlah_volume;
                  $total_pendapatan+=$jumlah_pendapatan;
                  ?>
                  <tr>
                    <td>{{$nomer}}</td>
                    <td>{{$i->stasiun->nama_stasiun}}</td>
                    <td>{{number_format($jumlah_volume,0,',','.')}}</td>
                    <td>Rp.{{number_format($jumlah_pendapatan,2,',','.')}}</td>
                    <td>
                      <form class="" action="lihat/cektombol" method="post">
                      {{csrf_field()}}
                      <input type="hidden" name="tanggal" value="{{$tanggal}}">
                      <input type="hidden" name="stasiun_id" value="{{$stasiun}}">
                      <button type="submit" class="btn-info" name="lihat" value="1">Lihat</button>
                      @if(Auth::user()->level==1||Auth::user()->level==2)
                      <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                      <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                      @endif
                    </form>
                    </td>
                  </tr>
                  @else
                    <?php
                      $jumlah_pendapatan+=$i->pendapatan;
                      $jumlah_volume+=$i->volume;
                    ?>
                  @endif
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Total</th>
                <th>Semua</th>
                <th>{{number_format($total_volume,0,',','.')}}</th>
                <th>Rp.{{number_format($total_pendapatan,2,',','.')}}</th>
                <th>
                  <form class="" action="/penumpang/komulatif" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="tanggal" value="{{$tanggal}}">
                    <button type="submit" class="btn-info" name="lihat">Lihat Lebih Lanjut</button>
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
