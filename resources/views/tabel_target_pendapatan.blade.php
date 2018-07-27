@extends('template.master')

@section('judulhalaman','Rekap Target')
@section('judulpage')
  <h1>Tabel Data Target <small>Tahun {{$tanggal}}</small></h1>

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
          <div class="box box-default color-palette-box">
            <div class="box-header with-border">
              <form class="form-horizontal" action="" method="post">
                {{csrf_field()}}
                <div class="col-lg-6">
                  <div class="col-lg-5">
                    <div class="input-group date">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tahun"  required>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" name="button" class="btn btn-info">Pilih</button>
                  </div>

                </div>
              </form>
              <form class="col-sm-2" action="/target/edit" method="post">
                {{csrf_field()}}
                <input type="hidden" name="tanggal" value="{{$tanggal}}">
                @if(Auth::user()->level==1)
                <button type="submit" class="btn btn-block btn-success"value="edit">Edit</button>
                @endif
              </form>

            </div>
            <div class="box-body table-responsive no-padding">
              @if(count($data_target)>0)
              <div class="col-lg-6">
                <div class="box box-default color-palette-box">

                  <div class="box-header with-border">
                    <h3 class="box-title">Target Penumpang</h3>
                  </div>
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <tbody>
                       <tr>
                          <th>Jenis</th>
                          <td align=right><b>Volume</b></td>
                          <td align=right><b>Pendapatan</b></td>
                       </tr>
                       @php($total_volume=0)
                       @php($total_pendapatan=0)
                       @foreach($data_target as $i)
                        @if($i->jenis!='Barang' && $i->jenis!='NonAngkutan')
                        <tr>
                          <td>{{$i->jenis}}</td>
                          <td align=right>{{number_format($i->volume,0,',','.')}}</td>
                          <td align=right>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
                        </tr>
                        @php($total_volume+=$i->volume)
                        @php($total_pendapatan+=$i->pendapatan)
                        @endif
                       @endforeach
                       <tr>
                          <th>Jumlah</th>
                          <td align=right><b>{{number_format($total_volume,0,',','.')}}</b></td>
                          <td align=right><b>Rp.{{number_format($total_pendapatan,2,',','.')}}</b></td>
                      </tr>
                  </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="box box-default color-palette-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Target</h3>
                  </div>
                  <div class="box-body table-responsive no-padding">
                    <h4>Target Penumpang Volume :{{number_format($total_volume,0,',','.')}} </h4>
                    <h4>Target Penumpang Pendapatan : Rp{{number_format($total_pendapatan,2,',','.')}}</h4>
                    @foreach($data_target as $i)
                     @if($i->jenis=='Barang' || $i->jenis=='NonAngkutan')
                      <h4>Target {{$i->jenis}} Rp{{number_format($i->pendapatan,2,',','.')}}</h4>
                     @endif
                    @endforeach
                  </div>
                </div>
              </div>
              @else
                <h4>Tidak ada data target pada tahun {{$tanggal}}</h4>
              @endif
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
 <script src="{!!asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>
 <!-- InputMask -->
 <script src="{!!asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')!!}"></script>
 <!-- bootstrap datepicker -->
 <script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>

 <!-- DataTables -->
 <script src="{!!asset('bower_components/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
 <script src="{!!asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}"></script>

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
         format:'yyyy',
         viewMode: "years",
         minViewMode: "years"
       });
   });
   </script>
@endsection
