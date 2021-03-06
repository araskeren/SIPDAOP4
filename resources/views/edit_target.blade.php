@extends('template.master')

@section('judulhalaman','Edit Target')
@section('judulpage','Edit Data Target')
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">
 <!-- Select2 -->
 <link rel="stylesheet" href="{!!asset('bower_components/select2/dist/css/select2.min.css')!!}">

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="row">
          <div class="col-xs-12">
            <form  action="/target/edited" method="post" class="form-horizontal">
            <div class="box">
                <div class="box-header">
                  <div class="col-lg-4">
                    <div class="input-group date">
                      <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal"  value="{{$tanggal}}">
                    </div>
                  </div>
              </div>
        <div class="row">

            {{csrf_field()}}
            <div class="col-lg-6">
              <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Penumpang Komulatif</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label for="volume_eksekutif" class="col-sm-2 control-label">Eksekutif</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="volume_eksekutif" id="volume_eksekutif" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Eksekutif " value="{{integertorupiah($data_target[0]->volume)}}" required>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="pendapatan_eksekutif" id="pendapatan_eksekutif" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Pendapatan Eksekutif "  value="Rp.{{integertorupiah($data_target[0]->pendapatan)}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="volume_bisnis" class="col-sm-2 control-label">Bisnis</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="volume_bisnis" id="volume_bisnis" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Bisnis"  value="{{integertorupiah($data_target[1]->volume)}}" required>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="pendapatan_bisnis" id="pendapatan_bisnis" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="pendapatan Bisnis"  value="Rp.{{integertorupiah($data_target[1]->pendapatan)}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="volume_ekonomi" class="col-sm-2 control-label">Ekonomi</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="volume_ekonomi" id="volume_ekonomi" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Ekonomi" value="{{integertorupiah($data_target[2]->volume)}}" required>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="pendapatan_ekonomi" id="pendapatan_ekonomi" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="pendapatan Ekonomi" value="Rp.{{integertorupiah($data_target[2]->pendapatan)}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="volume-lokal" class="col-sm-2 control-label">Lokal</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="volume_lokal" id="volume_lokal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  placeholder="Volume Lokal" value="{{integertorupiah($data_target[3]->volume)}}" required>
                    </div>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="pendapatan_lokal" id="pendapatan_lokal" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="pendapatan Lokal" value="Rp.{{integertorupiah($data_target[3]->pendapatan)}}" required>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-lg-6">
              <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Barang</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label for="pendapatan_barang" class="col-sm-2 control-label">Pendapatan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="pendapatan_barang" id="pendapatan_barang" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Pendapatan" value="Rp.{{integertorupiah($data_target[4]->pendapatan)}}">
                    </div>
                  </div>
              <div class="box box-default color-palette-box">
                 <div class="box-header with-border">
                  <h3 class="box-title">Non angkutan</h3>
                </div>
                  </div>
                  <div class="form-group">
                    <label for="pendapatan_nonangkutan" class="col-sm-2 control-label">Pendapatan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="pendapatan_nonangkutan" id="pendapatan_nonangkutan" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Pendapatan" value="Rp.{{integertorupiah($data_target[5]->pendapatan)}}" >
                    </div>
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-default pull-left">HAPUS SEMUA INPUTAN</button>
                  <button type="submit" class="btn btn-info pull-right">EDIT DATA</button>
                </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2018 <a href="#">PT KAI</a>.</strong> All rights reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
@endsection

@section('scripttambahan')
<!--
  Tempatnya Script tambahan
  Formatnya :
  <script src="{!! asset('path') !!}"></script>
 -->
 <script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>
 <!-- Select2 -->
 <script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>
 <script src="{!! asset('js/my.js')!!}"></script>

 <script>
  //   $(function () {
  //    $('#data-penumpang').DataTable({
  //     'paging'      : true,
  //     'lengthChange': true,
  //     'searching'   : true,
  //     'ordering'    : true,
  //     'info'        : true,
  //     'autoWidth'   : false,
  //     'scrollY'     : '270px',
  //     'scrollCollapse': true,
  //  })
  //   $('.select2').select2()
  // })
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
