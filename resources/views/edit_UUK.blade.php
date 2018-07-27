@extends('template.master')

@section('judulhalaman','Edit UUK')
@section('judulpage','Edit Pendapatan UUK')
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 --><!-- DataTables -->
 <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">
<link rel="stylesheet" href="{!!asset('dist/css/skins/skin-blue.min.css')!!}">
@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="row">
    <div class="col-lg-6">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
 <h3 class="box-title">Edit Pendapatan UUK</h3>

        </div>
        <div class="box-body">
          <form class="" action='/uuk/edit' method="post" class="form-horizontal">
            <div class="form-group">
              <label for="tanggal" class="col-sm-3 control-label">Tanggal </label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" required value="{{format_tanggal($tanggal)}}" disabled>
                </div>
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
                <label for="Pendapatan_UUK" class="col-sm-3 control-label">Pendapatan UUK</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="Pendapatan_UUK" id="Pendapatan_UUK" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Rp." required value="Rp.{{integertorupiah($data_uuk->value)}}">
                </div>
            </div>
        </div>
        <div class="box-footer">
            @if(Auth::user()->level==1||Auth::user()->level==7)
            {{csrf_field()}}
            <!-- <button type="submit" class="btn btn-default pull-left">HAPUS SEMUA INPUTAN</button> -->
            <button type="submit" class="btn btn-info pull-right">EDIT</button>
            @endif
        </div>
      </div>
        </form>
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
 <script src="bower_components/select2/dist/js/select2.full.min.js"></script>

 <!-- bootstrap datepicker -->
 <script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>
 <!-- konversi -->
 <script src="{!! asset('js/my.js')!!}"></script>

 <script>
 $(document).ready(function () {
     $('#datepicker').datepicker({
       locale: 'id',
       autoclose:true,
       format:'dd-mm-yyyy',
     });
 });
 </script>
@endsection
