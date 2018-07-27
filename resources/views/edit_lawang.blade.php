@extends('template.master')

@section('judulhalaman','Edit Lawang Sewu')
@section('judulpage','Edit Pendapatan Museum Lawang Sewu')
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">
<link rel="stylesheet" href="{!!asset('dist/css/skins/skin-blue.min.css')!!}">
@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="row">
    <div class="col-lg-8">
      <div class="box box-default color-palette-box">
        <form action="/lawang/edit" method="post" class="form-horizontal">
        <div class="box-body">
            <div class="form-group">
              <label for="tanggal" class="col-sm-3 control-label">Tanggal </label>
              <div class="col-sm-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal"  value="{{format_tanggal(($tanggal)->todatestring())}}" disabled>
                </div>
              </div>
            </div>
            <div class="row">
                    <h4 class="col-sm-3">Wisatawan Lokal</h4>
                </div>
                <div class="form-group">
                    <label for="lokal_Dewasa" class="col-sm-2 control-label">Dewasa</label>

             <div class="col-sm-2">

                      <input type="number" class="form-control" name="volume_lokal_dewasa" id="volume_lokal_dewasa" placeholder="Volume" value="{{$data_lawang[0]->volume}}" required>
                       </div>

                       <div class="col-sm-4">
                                <input type="number" class="form-control" name="satuan_lokal_dewasa" id="satuan_lokal_dewasa" placeholder="satuan_dewasa" value="{{$data_lawang[0]->satuan}}"required>
                                 </div>

                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="pendapatan_lokal_dewasa" id="pendapatan_lokal_dewasa" placeholder="Rp." value="Rp.{{$data_lawang[0]->total}}" readonly>

       </div>

            </div>


            <div class="form-group">
                    <label for="lokal_anak" class="col-sm-2 control-label">Anak-Anak</label>

             <div class="col-sm-2">

                      <input type="number" class="form-control" name="volume_lokal_anak" id="volume_lokal_anak" placeholder="volume" value="{{$data_lawang[1]->volume}}" required>
                       </div>
                       <div class="col-sm-4">
                                <input type="number" class="form-control" name="satuan_lokal_anak" id="satuan_lokal_anak" placeholder="satuan_anak" value="{{$data_lawang[1]->satuan}}"required>
                                 </div>
                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="pendapatan_lokal_anak" id="pendapatan_lokal_anak" placeholder="Rp." value="Rp.{{$data_lawang[1]->total}}"readonly>



       </div>
</div>
 <div class="form-group">
                    <label for="total-tiket-masuk-lokal" class="col-sm-4 control-label">Total Tiket Lokal</label>

             <div class="col-sm-4">
                      <input type="text" class="form-control" name="volume_total_lokal" id="volume_total_lokal" placeholder="volume_total_lokal" value="{{$data_lawang[0]->volume + $data_lawang[1]->volume}}" readonly>
                       </div>
                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="total_pendapatan_lokal" id="total_pendapatan_lokal" placeholder="Rp." value="Rp.{{$data_lawang[0]->total + $data_lawang[1]->total}}"readonly>



       </div>

            </div>
<div class="row">
                    <h4 class="col-sm-3">Wisatawan Asing</h4>
            </div>


            <div class="form-group">
                    <label for="wisman_dewasa" class="col-sm-2 control-label"> Dewasa</label>

             <div class="col-sm-2">

                      <input type="number" class="form-control" name="volume_wisman_dewasa" id="volume_wisman_dewasa" placeholder="volume" value="{{$data_lawang[2]->volume}}" required>
                       </div>
                       <div class="col-sm-4">
                                <input type="number" class="form-control" name="satuan_wisman_dewasa" id="satuan_wisman_dewasa" placeholder="satuan_dewasa" value="{{$data_lawang[2]->satuan}}" required>
                                 </div>
                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="pendapatan_wisman_dewasa" id="pendapatan_wisman_dewasa" placeholder="Rp." value="Rp.{{$data_lawang[2]->total}}" readonly>



        </div>
            </div>

            <div class="form-group">
                    <label for="wisman_anak" class="col-sm-2 control-label"> Anak</label>

             <div class="col-sm-2">

                      <input type="number" class="form-control" name="volume_wisman_anak" id="volume_wisman_anak" placeholder="volume" value="{{$data_lawang[3]->volume}}" required>
                       </div>
                       <div class="col-sm-4">
                          <input type="number" class="form-control" name="satuan_wisman_anak" id="satuan_wisman_anak" placeholder="satuan_anak" value="{{$data_lawang[3]->satuan}}"required>
                        </div>
                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="pendapatan_wisman_anak" id="pendapatan_wisman_anak" placeholder="Rp."  value="Rp.{{$data_lawang[3]->total}}"readonly>
                      </div>
            </div>



            <div class="form-group">
                    <label for="total-tiket-masuk-asing" class="col-sm-4 control-label">Total Tiket Asing</label>

             <div class="col-sm-4">

                      <input type="text" class="form-control" name="volume_total_wisman" id="volume_total_wisman" placeholder="volume_total_wisman"  value="{{$data_lawang[2]->volume + $data_lawang[3]->volume}}" readonly>
                       </div>
                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="total_pendapatan_wisman" id="total_pendapatan_wisman" placeholder="Rp."  value="Rp.{{$data_lawang[2]->satuan + $data_lawang[3]->total}}" readonly>

       </div>

            </div>
                <div class="row">
                    <h4 class="col-sm-3">Total Tiket Masuk</h4>
            </div>
        <div class="form-group">
                    <label for="total-tiket-masuk" class="col-sm-4 control-label">Total</label>

             <div class="col-sm-4">

                      <input type="text" class="form-control" name="volume_total_tiket" id="volume_total_tiket" placeholder="volume_total_tiket"  value="{{$data_lawang[0]->volume + $data_lawang[1]->volume + $data_lawang[2]->volume + $data_lawang[3]->volume}}"readonly>
                       </div>
                       <div class="col-sm-4">
                        <input type="text" class="form-control" name="total_pendapatan_tiket" id="total_pendapatan_tiket" placeholder="Rp."  value="Rp.{{$data_lawang[0]->total + $data_lawang[1]->total + $data_lawang[2]->total + $data_lawang[3]->total}}" readonly>
                      </div>

            </div>



            </div>
            <div class="box-footer">
              @if(Auth::user()->level==1||Auth::user()->level==5||Auth::user()->level==4)
              {{csrf_field()}}
              <!-- <button type="submit" class="btn btn-default pull-left">Clear</button> -->
                <button type="submit" class="btn btn-info pull-right">EDIT</button>
                  @endif
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
 <script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>


 <script>
 $(document).ready(function () {
     $('#datepicker').datepicker({
       locale: 'id',
       autoclose:true,
       format:'dd-mm-yyyy',
     });
  $('#volume_lokal_dewasa').change(function(){
    var volume=parseInt($('#volume_lokal_dewasa').val());
    var satuan=parseInt($('#satuan_lokal_dewasa').val());
    $('#pendapatan_lokal_dewasa').val("Rp."+jumlahPendapatan(volume,satuan));
    totalLokal();
  });
  $('#satuan_lokal_dewasa').change(function(){
     var volume=parseInt($('#volume_lokal_dewasa').val());
     var satuan=parseInt($('#satuan_lokal_dewasa').val());
     $('#pendapatan_lokal_dewasa').val("Rp."+jumlahPendapatan(volume,satuan));
     totalLokal();
   });

   $('#volume_lokal_anak').change(function(){
     var volume=parseInt($('#volume_lokal_anak').val());
     var satuan=parseInt($('#satuan_lokal_anak').val());
     $('#pendapatan_lokal_anak').val("Rp."+jumlahPendapatan(volume,satuan));
     totalLokal();
   });
 $('#satuan_lokal_anak').change(function(){
     var volume=parseInt($('#volume_lokal_anak').val());
       var satuan=parseInt($('#satuan_lokal_anak').val());
     $('#pendapatan_lokal_anak').val("Rp."+jumlahPendapatan(volume,satuan));
     totalLokal();
 });
 $('#volume_wisman_dewasa').change(function(){
   var volume=parseInt($('#volume_wisman_dewasa').val());
   var satuan=parseInt($('#satuan_wisman_dewasa').val());
   $('#pendapatan_wisman_dewasa').val("Rp."+jumlahPendapatan(volume,satuan));
   totalWisman();
 });

 $('#satuan_wisman_dewasa').change(function(){
    var volume=parseInt($('#volume_wisman_dewasa').val());
    var satuan=parseInt($('#satuan_wisman_dewasa').val());
    $('#pendapatan_wisman_dewasa').val("Rp."+jumlahPendapatan(volume,satuan));
    totalWisman();
});
$('#volume_wisman_anak').change(function(){
  var volume=parseInt($('#volume_wisman_anak').val());
  var satuan=parseInt($('#satuan_wisman_anak').val());
  $('#pendapatan_wisman_anak').val("Rp."+jumlahPendapatan(volume,satuan));
  totalWisman();
});
$('#satuan_wisman_anak').change(function(){
   var volume=parseInt($('#volume_wisman_anak').val());
     var satuan=parseInt($('#satuan_wisman_anak').val());
   $('#pendapatan_wisman_anak').val("Rp."+jumlahPendapatan(volume,satuan));

   totalWisman();
});

function jumlahPendapatan(volume,satuan){
 return volume*satuan;
}

function totalLokal(){
 jumlahLokalVolume();
 jumlahLokalPendapatan();
 jumlahTotalPendapatan();
 jumlahTotalVolume();
}
function totalWisman(){
 jumlahwismanVolume();
 jumlahwismanPendapatan();
 jumlahTotalPendapatan();
 jumlahTotalVolume();
}

function jumlahLokalVolume(){
 var volumeanak=parseInt($('#volume_lokal_anak').val());
 var volumedewasa=parseInt($('#volume_lokal_dewasa').val());
 var volume=volumeanak+volumedewasa;
 $('#volume_total_lokal').val(volume);
 return volume;
}
function jumlahLokalPendapatan(){
 var volumeanak=parseInt($('#volume_lokal_anak').val());
 var volumedewasa=parseInt($('#volume_lokal_dewasa').val());
   var satuan_lokal_anak=parseInt($('#satuan_lokal_anak').val());
     var satuan_lokal_dewasa=parseInt($('#satuan_lokal_dewasa').val());
 var pendapatananak=volumeanak*satuan_lokal_anak;
 var pendapatandewasa=volumedewasa*satuan_lokal_dewasa;
 var pendapatan=pendapatananak+pendapatandewasa;
 $('#total_pendapatan_lokal').val("Rp."+pendapatan);
 return pendapatan;
}
function jumlahwismanVolume(){
 var volumeanak=parseInt($('#volume_wisman_anak').val());
 var volumedewasa=parseInt($('#volume_wisman_dewasa').val());
 var volume=volumeanak+volumedewasa;
 $('#volume_total_wisman').val(volume);
 return volume;
}
function jumlahwismanPendapatan(){
 var volumeanak=parseInt($('#volume_wisman_anak').val());
 var volumedewasa=parseInt($('#volume_wisman_dewasa').val());
 var satuan_wisman_anak=parseInt($('#satuan_wisman_anak').val());
   var satuan_wisman_dewasa=parseInt($('#satuan_wisman_dewasa').val());
 var pendapatananak=volumeanak*satuan_wisman_anak
 var pendapatandewasa=volumedewasa*satuan_wisman_dewasa;
 var pendapatan=pendapatananak+pendapatandewasa;
 $('#total_pendapatan_wisman').val("Rp."+pendapatan);
 return pendapatan;
}

function jumlahTotalPendapatan(){
 total=jumlahLokalPendapatan()+jumlahwismanPendapatan();
 $('#total_pendapatan_tiket').val("Rp."+total);
}
function jumlahTotalVolume(){
 volume=jumlahLokalVolume()+jumlahwismanVolume();
 $('#volume_total_tiket').val(volume);
}


 });

 </script>
@endsection
