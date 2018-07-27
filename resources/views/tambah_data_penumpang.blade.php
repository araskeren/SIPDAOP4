@extends('template.master')

@section('judulhalaman','Tambah Penumpang')
@section('judulpage','Tambah Data Penumpang')
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">
 <!-- Select2 -->
 <link rel="stylesheet" href="{!!asset('bower_components/select2/dist/css/select2.min.css')!!}">

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <!-- Koding disini -->
  @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
  <form  action="" method="post" class="form-horizontal">
   <div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
            <div class="col-lg-4">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" required value="{{$tanggal}}">
              <input type="hidden" name="stasiun" value="0">
              </div>
            </div>
            <div class="col-lg-4">
            </div>
          </div>
   <div class="row">
      <div class="col-lg-6">
        <div class="box box-default color-palette-box">
          <div class="box-header with-border">
            <h3 class="box-title">Volume</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="Volume_Eksekutif" class="col-sm-2 control-label">Eksekutif</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Volume_Eksekutif" id="Volume_Eksekutif" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" placeholder="Volume Eksekutif"required>
              </div>
            </div>
            <div class="form-group">
              <label for="Volume_Bisnis" class="col-sm-2 control-label">Bisnis</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Volume_Bisnis" id="Volume_Bisnis" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  placeholder="Volume Bisnis"required>
              </div>
            </div>
            <div class="form-group">
              <label for="Volume_Ekonomi" class="col-sm-2 control-label">Ekonomi</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Volume_Ekonomi" id="Volume_Ekonomi" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  placeholder="Volume Ekonomi" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Volume_Lokal" class="col-sm-2 control-label">Lokal</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Volume_Lokal" id="Volume_Lokal" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"  placeholder="Volume Lokal" required>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-6">
        <div class="box box-default color-palette-box">
          <div class="box-header with-border">
            <h3 class="box-title">Pendapatan</h3>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label for="Pendapatan_Eksekutif" class="col-sm-2 control-label">Eksekutif</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="Pendapatan_Eksekutif" id="Pendapatan_Eksekutif" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);"  placeholder="Pendapatan Eksekutif" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Pendapatan_Bisnis" class="col-sm-2 control-label">Bisnis</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Pendapatan_Bisnis" id="Pendapatan_Bisnis" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);"  placeholder="Pendapatan Bisnis" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Pendapatan_Ekonomi" class="col-sm-2 control-label">Ekonomi</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Pendapatan_Ekonomi" id="Pendapatan_Ekonomi" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);"  placeholder="Pendapatan Ekonomi" required>
              </div>
            </div>
            <div class="form-group">
              <label for="Pendapatan_Lokal" class="col-sm-2 control-label">Lokal</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="Pendapatan_Lokal" id="Pendapatane_Lokal" onkeydown="return numbersonlyrupiah(this, event);" onkeyup="javascript:rupiah(this);"  placeholder="Pendapatan Lokal" required>
              </div>
            </div>
          </div>
          <div class="box-footer">
            @if(Auth::user()->level==1||Auth::user()->level==2)
            {{csrf_field()}}
            <!-- <button type="submit" class="btn btn-default pull-left">HAPUS SEMUA INPUTAN</button> -->
            <button type="submit" class="btn btn-info pull-right">TAMBAH DATA</button>
            @endif
          </div>
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
 <!-- bootstrap datepicker -->
<script src="{!! asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>
<!-- Select2 -->
<script src="{!! asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>
<script src="{!! asset('js/my.js')!!}"></script>
 <script>
 $(function () {
 $('.select2').select2();
 })
 $(document).ready(function () {
  $('#datepicker').datepicker({
    locale: 'id',
    autoclose:true,
    format:'dd-mm-yyyy'
  }).on("change", function() {
    $("#stasiun").find('option').remove().end().append('<option selected disabled>Pilih Stasiun</option>');

    var tanggal=$(this).val();
    $.ajax({
      url:'/penumpang/get/stasiun',
      type:'POST',
      data:{
        tanggal:tanggal,
        _token:'{{csrf_token()}}',
      },
      success:function(data){
        console.log(data);
         $.each(data, function(index, val) {
             $("#stasiun").append('<option value='+val.id+'>'+val.nama_stasiun+'</option>');
         });
      },error:function(){
          alert("Error Saat Mengambil data stasiun!!!!");
      }
    });
  });
 });
 </script>
@endsection
