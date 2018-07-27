@extends('template.master')

@section('judulhalaman','Edit Barang')
@section('judulpage','Edit Data Barang')
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
    <form  action="{{URL('/barang/edit')}}" method="post" class="form-horizontal">
      <div class="col-lg-12">
        <div class="box box-default color-palette-box">
          <div class="box-header with-border">
            <div class="col-lg-4">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal"  value="{{format_tanggal($tanggal)}}" disabled>
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
                        <input type="text" class="form-control" name="Volume_Petikemas" id="Volume_Petikemas" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Semen(TON)" value="{{integertorupiah($data_barang[0]->volume)}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Volume_Semen" class="col-sm-2 control-label"> Semen </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="Volume_Semen" id="Volume_Semen" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Semen(TON)" value="{{integertorupiah($data_barang[1]->volume)}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Volume_BBM" class="col-sm-2 control-label"> BBM</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="Volume_BBM" id="Volume_BBM" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume BBM (L)" value="{{integertorupiah($data_barang[2]->volume)}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Volume_Cargo" class="col-sm-2 control-label"> Cargo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="Volume_Cargo" id="Volume_Cargo" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Cargo (TON)" value="{{integertorupiah($data_barang[3]->volume)}}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Volume_KA_Lain" class="col-sm-2 control-label">KA Lain</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="Volume_KA_Lain" id="Volume_KA_Lain" onkeydown="return numbersonly(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Ka lain (Ton)" value="{{integertorupiah($data_barang[4]->volume)}}"required>
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
                        <input type="text" class="form-control" name="pendapatan_Petikemas" id="pendapata_Petikemas" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Petikemas(Rp)" value="Rp.{{integertorupiah($data_barang[0]->pendapatan)}}"required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pendapatan_Semen" class="col-sm-2 control-label">Semen</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="pendapatan_Semen" id="pendapatan_Semen" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Semen (Rp)" value="Rp.{{integertorupiah($data_barang[1]->pendapatan)}}"required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pendapatan_BBM" class="col-sm-2 control-label">BBM</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="pendapatan_BBM" id="pendapatan_BBM" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan BBM (Rp)" value="Rp.{{integertorupiah($data_barang[2]->pendapatan)}}"required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pendapatan_Cargo" class="col-sm-2 control-label">Cargo</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="pendapatan_Cargo" id="pendapatan_Cargo" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Cargo(Rp)" value="Rp.{{integertorupiah($data_barang[3]->pendapatan)}}"required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pendapatan_Ka_Lain " class="col-sm-2 control-label">KA Lain</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="pendapatan_Ka_Lain" id="Pendapatan_Sharing" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Sharing (Rp)" value="Rp.{{integertorupiah($data_barang[4]->pendapatan)}}"required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pendapatan_Sharing " class="col-sm-2 control-label">KA Lain</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="pendapatan_Sharing" id="pendapatan_Sharing" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);" placeholder="Pendapatan Sharing (Rp)" value="Rp.{{integertorupiah($data_barang[5]->pendapatan)}}"required>
                      </div>
                    </div>
                  </div>
                  <!--<div class="box-footer">
                    <button type="submit" class="btn btn-default pull-left">HAPUS INPUTAN DATA Pendapatan</button>
                  </div>-->
                </div>
              </div>
                  <div class="box-footer">
                  <!--  <button type="submit" class="btn btn-default pull-left">HAPUS SEMUA INPUTAN</button> -->
                    @if(Auth::user()->level==1||Auth::user()->level==3)
                  {{csrf_field()}}
                    <button type="submit" class="btn btn-info pull-right">EDIT DATA</button>
                      @endif
                  </div>
                </form>
                </div>
              </div>
            </div>
    </form>
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
 <!-- konversi -->
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
