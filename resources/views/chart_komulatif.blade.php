@extends('template.master')

@section('judulhalaman','Welcome')
@section('judulpage')
<h1>Selamat Datang User {{Auth::user()->name}}
</h1>
<ol class="breadcrumb">
  <select class="form-control" id="pilih-tampilan">
    <option disabled selected>Pilih Tampilan</option>
    <option value="7">Mingguan</option>
    <option value="30">Bulanan</option>
    <option value="365">Tahunan</option>
  </select>
</ol>
<br>
@endsection
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <!-- Morris charts -->
  <link rel="stylesheet" href="{!!asset('bower_components/morris.js/morris.css') !!}">
@endsection
@section('konten')
<!-- Tempatnya Konten -->
<div class="row">
      <div class="col-md-6">
        <!-- Pendapatan Penumpang -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pendapatan Penumpang</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="pendapatan-penumpang" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col (LEFT) -->
      <div class="col-md-6">
    <!-- Volume Penumpang -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Volume Penumpang</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="volume-penumpang" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->


  <div class="row">
    <!-- /.col (LEFT) -->
      <div class="col-md-6">
        <!-- Pendapatan Barang -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pendapatan Barang</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="pendapatan-barang" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    <!-- ./col(RIGHT)   -->
    <div class="col-md-6">
      <!-- Pendapatan Non Angkutan -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pendapatan Non Angkutan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body chart-responsive">
          <div class="chart" id="non-angkutan" style="height: 300px;"></div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    </div>
    <!-- /.row -->

  <div class="row">
      <div class="col-md-6">
        <!-- Pendapatan DAOP 4 -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pendapatan DAOP 4</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="daop4" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
@endsection

@section('scripttambahan')
<!--
  Tempatnya Script tambahan
  Formatnya :
  <script src="{!! asset('path') !!}"></script>
 -->
 <script src="{!! asset('bower_components/morris.js/morris.min.js') !!}"></script>
 <script src="{!! asset('bower_components/raphael/raphael.min.js') !!}"></script>
 <script src="{!! asset('bower_components/bootstrap/js/BigInteger.min.js')!!}"></script>
 <!-- page script -->
 <script>
   $("#pilih-tampilan").change(function(){
     var value = $("#pilih-tampilan").val();
     location.href = 'http://localhost/KAI/chart/komulatif/'+value;
     console.log(value);
   });
   function konversiTanggal($tanggal){
     var tanggal=new Date($tanggal)
     var year = tanggal.getFullYear();
     var month = tanggal.getMonth()+1;
     var day = tanggal.getDate();

     if (day < 10) {
       day = '0' + day;
     }
     if (month < 10) {
       month = '0' + month;
     }

     var formattedDate = year + '-' + month + '-' + day;
     return formattedDate;
   }
   $(function () {
     "use strict";

     // Penumpang
     var penumpang = <?php echo $penumpang ?>;
     var awal=penumpang[0].created_at;
     var z=0;
     var pendapatan=0;
     var volume=0;
     for(var i=0;i<penumpang.length;i++){
       var sekarang=penumpang[i].created_at;
       if(awal==sekarang){
          pendapatan+=penumpang[i].pendapatan;
          volume+=penumpang[i].volume;
       }else{

         var x=[{y: konversiTanggal(awal), item1: pendapatan,}];
         var y=[{y: konversiTanggal(awal), item1: volume}];
         if(z!=0){
           pendapatan_penumpang.push({y: konversiTanggal(awal) , item1: pendapatan,});
           volume_penumpang.push({y: konversiTanggal(awal), item1: volume});
         }else{
           var pendapatan_penumpang=x;
           var volume_penumpang=y
         }
         pendapatan=penumpang[i].pendapatan;
         volume=penumpang[i].volume;
         awal=sekarang;
         z++;
       }
     }

     var area = new Morris.Line({
         element: 'pendapatan-penumpang',
         resize: true,
         data:pendapatan_penumpang,
         xkey: 'y',
         ykeys: ['item1'],
         labels: ['Pendapatan Penumpang'],
         lineColors: ['#F44336'],
         hideHover: 'auto',
          xLabels:'day',
          xLabelFormat: function (d) {
          var weekdays = new Array(7);
          var bulan=new Array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
          weekdays[0] = "Minggu";
          weekdays[1] = "Senin,";
          weekdays[2] = "Selasa";
          weekdays[3] = "Rabu";
          weekdays[4] = "Kamis";
          weekdays[5] = "Jumat";
          weekdays[6] = "Sabtu";

     		return weekdays[d.getDay()] + ',' +
     				("0" + (d.getDate())).slice(-2) + '-' +
     			   bulan[d.getMonth()]
     			   ;
     	  },
     });

   	 var area = new Morris.Line({
         element: 'volume-penumpang',
         resize: true,
         data:volume_penumpang,
         xkey: 'y',
         ykeys: ['item1'],
         labels: ['Volume'],
         lineColors: ['#F44336'],
         hideHover: 'auto',
       	  xLabels:'day',
       	  xLabelFormat: function (d) {
       		var weekdays = new Array(7);
       		var bulan=new Array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
       		weekdays[0] = "Minggu";
       		weekdays[1] = "Senin,";
       		weekdays[2] = "Selasa";
       		weekdays[3] = "Rabu";
       		weekdays[4] = "Kamis";
       		weekdays[5] = "Jumat";
       		weekdays[6] = "Sabtu";

     		return weekdays[d.getDay()] + ',' +
     				("0" + (d.getDate())).slice(-2) + '-' +
     			   bulan[d.getMonth()]
     			   ;
     	  },
       });

    // Barang
    var barang = <?php echo $barang ?>;
    var awal=barang[0].created_at;
    var z=0;
    var pendapatan=0;
    for(var i=0;i<barang.length;i++){
      var sekarang=barang[i].created_at;
      if(awal==sekarang){
        pendapatan+=barang[i].pendapatan;
      }else{
        var x=[{y: konversiTanggal(awal), item1: pendapatan}];
        if(z!=0){
          pendapatan_barang.push({y: konversiTanggal(awal), item1: pendapatan});
        }else{
          var pendapatan_barang=x;
        }
        pendapatan=barang[i].pendapatan;
        awal=sekarang;
        z++;
      }
    }

   	var area = new Morris.Line({
         element: 'pendapatan-barang',
         resize: true,
         data: pendapatan_barang,
         xkey: 'y',
         ykeys: ['item1'],
         labels: ['Pendapatan'],
         lineColors: ['#F44336'],
         hideHover: 'auto',
   	  xLabels:'day',
   	  xLabelFormat: function (d) {
   		var weekdays = new Array(7);
   		var bulan=new Array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
   		weekdays[0] = "Minggu";
   		weekdays[1] = "Senin,";
   		weekdays[2] = "Selasa";
   		weekdays[3] = "Rabu";
   		weekdays[4] = "Kamis";
   		weekdays[5] = "Jumat";
   		weekdays[6] = "Sabtu";

   		return weekdays[d.getDay()] + ',' +
   				("0" + (d.getDate())).slice(-2) + '-' +
   			   bulan[d.getMonth()]
   			   ;
   	  },
       });

   // Non Angkutan
   var nonangkutan = <?php echo json_encode($nonangkutan)?>;

   for (var i = 0; i < nonangkutan.length; i++) {
    var jumlah_total=bigInt(nonangkutan[i]['pa'])+nonangkutan[i]['ambarawa']+nonangkutan[i]['lawang']+nonangkutan[i]['uuk'];
    x=[{y: nonangkutan[i]['created_at'], item1: jumlah_total}];
    if(i!=0){
      non_angkutan.push({y: nonangkutan[i]['created_at'], item1:jumlah_total});
    }else{
      var non_angkutan=x;
    }
   }

   var area = new Morris.Line({
        element: 'non-angkutan',
        resize: true,
        data: non_angkutan,
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Pendapatan'],
        lineColors: ['#F44336'],
        hideHover: 'auto',
     xLabels:'day',
     xLabelFormat: function (d) {
     var weekdays = new Array(7);
     var bulan=new Array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
     weekdays[0] = "Minggu";
     weekdays[1] = "Senin,";
     weekdays[2] = "Selasa";
     weekdays[3] = "Rabu";
     weekdays[4] = "Kamis";
     weekdays[5] = "Jumat";
     weekdays[6] = "Sabtu";

     return weekdays[d.getDay()] + ',' +
         ("0" + (d.getDate())).slice(-2) + '-' +
          bulan[d.getMonth()]
          ;
     },
      });



   for (var i = 0; i <pendapatan_penumpang.length; i++) {
    var sekarang=pendapatan_penumpang[i].y;
    var total=pendapatan_penumpang[i].item1;

    for (var y = 0; y < pendapatan_barang.length; y++) {
      if(pendapatan_barang[y].y==sekarang){
        total+=pendapatan_barang[y].item1;
        break;
      }
    }
    for (var y = 0; y < non_angkutan.length; y++) {
      if(non_angkutan[y].y==sekarang){
        total+=non_angkutan[y].item1;
        break;
      }
    }
    x=[{y: pendapatan_penumpang[i].y, item1:total}];
    if(i!=0){
      daop.push({y: pendapatan_penumpang[i].y, item1:total})
    }else{
      var daop=x;
    }

   }

   var area = new Morris.Line({
        element: 'daop4',
        resize: true,
        data: daop,
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Pendapatan'],
        lineColors: ['#F44336'],
        hideHover: 'auto',
     xLabels:'day',
     xLabelFormat: function (d) {
     var weekdays = new Array(7);
     var bulan=new Array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Des");
     weekdays[0] = "Minggu";
     weekdays[1] = "Senin,";
     weekdays[2] = "Selasa";
     weekdays[3] = "Rabu";
     weekdays[4] = "Kamis";
     weekdays[5] = "Jumat";
     weekdays[6] = "Sabtu";

     return weekdays[d.getDay()] + ',' +
         ("0" + (d.getDate())).slice(-2) + '-' +
          bulan[d.getMonth()]
          ;
     },
      });
  });

 </script>

@endsection
