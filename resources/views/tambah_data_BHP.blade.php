@extends('template.master')

@section('judulhalaman','Tambah BHP')
@section('judulpage','Tambah Data BHP')
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
  @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div><br />
      @endif
  <div class="row">
    <form class="form-horizontal" action="{{URL('/barang/bhp/tambah')}}" method="post">
    <div class="col-lg-6">
      <div class="box">
          <div class="box-header">
              <div class="col-lg-8">
              <div class="input-group date">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" value="{{$tanggal}}">
              </div>
            </div>
          </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-default color-palette-box">
        <div class="box-body">
            <div class="col-lg-4">
              <div class="form-group">
                <select class="form-control select2" style="width: 100%; " name='stasiun' id="stasiun">
                  <option selected="selected" disabled>Pilih Stasiun</option>
                  @if(count($data_stasiun)>0)
                  @foreach($data_stasiun as $i)
                    <option value="{{$i['id']}}">{{$i['nama_stasiun']}}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="pendapatan" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" name="pendapatan">
            </div>
        </div>
          <div class="box-footer">
            @if(Auth::user()->level==1||Auth::user()->level==3)
            {{csrf_field()}}
            <!-- <button type="submit" class="btn btn-default pull-left">HAPUS SEMUA INPUTAN</button> -->
            <button type="submit" class="btn btn-info pull-right">TAMBAH DATA</button>
            @endif
          </div>
        </form>
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
    today:true,
  }).on("change", function() {
    $("#stasiun").find('option').remove().end().append('<option selected disabled>Pilih Stasiun</option>');

    var tanggal=$(this).val();
    $.ajax({
      url:'/barang/bhp/get/stasiun',
      type:'POST',
      data:{
        tanggal:tanggal,
        _token:'{{csrf_token()}}',
      },
      success:function(data){
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
