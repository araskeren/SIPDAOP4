@extends('template.master')

@section('judulhalaman','Tambah Barang')
@section('judulpage','Tambah Data Barang')
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
  @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
<form  action="{{URL('/barang/tambah')}}" method="post" class="form-horizontal">
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-default color-palette-box">
          <div class="box-header with-border">
            <div class="col-lg-6">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" value="{{format_tanggal($tanggal)}}" required>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="col-lg-6">
              <div class="box box-default color-palette-box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Volume Barang</h3>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="Volume_Petikemas" class="col-sm-2 control-label"> Petikemas </label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Volume_Petikemas" id="Volume_Petikemas" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Petikemas(TON)" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Volume_Semen" class="col-sm-2 control-label"> Semen </label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Volume_Semen" id="Volume_Semen" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Semen(TON)" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Volume_BBM" class="col-sm-2 control-label"> BBM</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Volume_BBM" id="Volume_BBM" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume BBM (L)" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Volume_Petikemas" class="col-sm-2 control-label"> Cargo </label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Volume_Cargo" id="Volume_Cargo" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Cargo(TON)" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Volume_KA_Lain" class="col-sm-2 control-label"> KA Lain </label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="Volume_KA_Lain" id="Volume_KA_Lain" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume KA Lain(TON)" required>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-lg-6">
              <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                      <h3 class="box-title">Pendapatan Barang</h3>
                    </div>
                <div class="box-body">
                  <div class="form-group">
                        <label for="pendapatan_Petikemas" class="col-sm-2 control-label">Petikemas</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pendapatan_Petikemas" id="pendapata_Petikemas" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Petikemas(Rp)"required>
                        </div>
                      </div>
                  <div class="form-group">
                        <label for="pendapatan_Semen" class="col-sm-2 control-label">Semen</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pendapatan_Semen" id="pendapatan_Semen" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Semen (Rp)"required>
                        </div>
                      </div>
                  <div class="form-group">
                        <label for="pendapatan_BBM" class="col-sm-2 control-label">BBM</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pendapatan_BBM" id="pendapatan_BBM" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan BBM (Rp)"  required>
                        </div>
                      </div>
                  <div class="form-group">
                        <label for="pendapatan_Cargo" class="col-sm-2 control-label">Cargo</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pendapatan_Cargo" id="pendapatan_Cargo" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Cargo(Rp)"required>
                        </div>
                      </div>
                  <div class="form-group">
                        <label for="pendapatan_Ka_Lain " class="col-sm-2 control-label">Ka Lain</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pendapatan_Ka_Lain" id="pendapatan_Ka_Lain" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan KA Lain (Rp)"required>
                        </div>
                      </div>
                  <div class="form-group">
                        <label for="pendapatan_Sharing " class="col-sm-2 control-label">Sharing</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="pendapatan_Sharing" id="pendapatan_Sharing" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Sharing (Rp)"required>
                        </div>
                      </div>
                </div>
                <div class="box-footer">
                      @if(Auth::user()->level==1||Auth::user()->level==3)
                      <!-- <button type="submit" class="btn btn-default pull-left">HAPUS SEMUA INPUTAN</button> -->
                      <button type="submit" class="btn btn-info pull-right">TAMBAH DATA</button>
                      @endif
                    </div>
              </div>
            </div>
          </div>
          {{csrf_field()}}
      </div>
    </div>
  </div>
</form>
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
 <!-- untuk js konversi -->
 <script src="{!! asset('js/my.js')!!}"></script>
 <script>
 $(function () {
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
