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
      <!-- /.col (LEFT) -->
      <div class="col-md-6">
    <!-- Volume Barang -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Volume Barang</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="volume-barang" style="height: 300px;"></div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!-- /.col (RIGHT) -->
    </div>
    <!-- /.row -->

  <div class="row">
      <div class="col-md-6">
        <!-- Pendapatan Barang -->
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
@endsection

@section('scripttambahan')
<!--
  Tempatnya Script tambahan
  Formatnya :
  <script src="{!! asset('path') !!}"></script>
 -->
 <script src="{!! asset('bower_components/morris.js/morris.min.js') !!}"></script>
 <script src="{!! asset('bower_components/raphael/raphael.min.js') !!}"></script>
 <!-- page script -->
 <script>
   $("#pilih-tampilan").change(function(){
     var value = $("#pilih-tampilan").val();
     location.href = 'http://localhost/KAI/'+value;
     console.log(value);
   });
   $(function () {
     "use strict";

     // Penumpang
     var penumpang = <?php echo $penumpang ?>;
     var awal=penumpang[0].created_at;
     var z=0;
     for(var i=0;i<penumpang.length;i++){
       var sekarang=penumpang[i].created_at;
       if(awal==sekarang){
         if(penumpang[i].jenis=='Eksekutif'){
           var eksekutif_pendapatan=penumpang[i].pendapatan;
           var eksekutif_volume=penumpang[i].volume;
         }else if(penumpang[i].jenis=='Bisnis'){
           var bisnis_pendapatan=penumpang[i].pendapatan;
           var bisnis_volume=penumpang[i].volume;
         }else if(penumpang[i].jenis=='Ekonomi'){
           var ekonomi_pendapatan=penumpang[i].pendapatan;
           var ekonomi_volume=penumpang[i].volume;
         }else if(penumpang[i].jenis=='Lokal'){
           var lokal_pendapatan=penumpang[i].pendapatan;
           var lokal_volume=penumpang[i].volume;
         }
       }else{
         var x=[{y: awal, item1: eksekutif_pendapatan, item2: bisnis_pendapatan, item3: ekonomi_pendapatan, item4: lokal_pendapatan}];
         var y=[{y: awal, item1: eksekutif_volume, item2: bisnis_volume, item3: ekonomi_volume, item4: lokal_volume}];
         if(z!=0){
           pendapatan_penumpang.push({y: awal, item1: eksekutif_pendapatan, item2: bisnis_pendapatan, item3: ekonomi_pendapatan, item4: lokal_pendapatan});
           volume_penumpang.push({y: awal, item1: eksekutif_volume, item2: bisnis_volume, item3: ekonomi_volume, item4: lokal_volume});
         }else{
           var pendapatan_penumpang=x;
           var volume_penumpang=y
         }

         //console.log(data);
         awal=sekarang;
         z++;
         if(penumpang[i].jenis=='Eksekutif'){
           var eksekutif_pendapatan=penumpang[i].pendapatan;
           var eksekutif_volume=penumpang[i].volume;
         }else if(penumpang[i].jenis=='Bisnis'){
           var bisnis_pendapatan=penumpang[i].pendapatan;
           var bisnis_volume=penumpang[i].volume;
         }else if(penumpang[i].jenis=='Ekonomi'){
           var ekonomi_pendapatan=penumpang[i].pendapatan;
           var ekonomi_volume=penumpang[i].volume;
         }else if(penumpang[i].jenis=='Lokal'){
           var lokal_pendapatan=penumpang[i].pendapatan;
           var lokal_volume=penumpang[i].volume;
         }
       }
     }

     var area = new Morris.Area({
         element: 'pendapatan-penumpang',
         resize: true,
         data:pendapatan_penumpang,
         xkey: 'y',
         ykeys: ['item1', 'item2','item3','item4'],
         labels: ['Eksekutif', 'Bisnis','Ekonomi','Lokal'],
         lineColors: ['#F44336', '#3F51B5','#9C27B0','#607D8B'],
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

   	var area = new Morris.Area({
         element: 'volume-penumpang',
         resize: true,
         data:volume_penumpang,
         xkey: 'y',
         ykeys: ['item1', 'item2','item3','item4'],
         labels: ['Eksekutif', 'Bisnis','Ekonomi','Lokal'],
         lineColors: ['#F44336', '#3F51B5','#9C27B0','#607D8B'],
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
    for(var i=0;i<barang.length;i++){
      var sekarang=barang[i].created_at;
      if(awal==sekarang){
        if(barang[i].jenis=='Petikemas'){
          var petikemas_pendapatan=barang[i].pendapatan;
          var petikemas_volume=barang[i].volume;
        }else if(barang[i].jenis=='Semen'){
          var semen_pendapatan=barang[i].pendapatan;
          var semen_volume=barang[i].volume;
        }else if(barang[i].jenis=='BBM'){
          var bbm_pendapatan=barang[i].pendapatan;
          var bbm_volume=barang[i].volume;
        }else if(barang[i].jenis=='Cargo'){
          var cargo_pendapatan=barang[i].pendapatan;
          var cargo_volume=barang[i].volume;
        }else if(barang[i].jenis=='Ka Lain'){
          var ka_lain_pendapatan=barang[i].pendapatan;
          var ka_lain_volume=barang[i].volume;
        }else if(barang[i].jenis=='Sharing'){
          var sharing_pendapatan=barang[i].pendapatan;
        }
      }else{
        var x=[{y: awal, item1: petikemas_pendapatan, item2: semen_pendapatan, item3: bbm_pendapatan, item4: cargo_pendapatan,item5:ka_lain_pendapatan,item6:sharing_pendapatan}];
        var y=[{y: awal, item1: petikemas_volume, item2: semen_volume, item3: bbm_volume, item4: cargo_volume,item5:ka_lain_volume,item6:sharing_pendapatan}];
        if(z!=0){
          pendapatan_barang.push({y: awal, item1: petikemas_pendapatan, item2: semen_pendapatan, item3: bbm_pendapatan, item4: cargo_pendapatan,item5:ka_lain_pendapatan,item6:sharing_pendapatan});
          volume_barang.push({y: awal, item1: petikemas_volume, item2: semen_volume, item3: bbm_volume, item4: cargo_volume,item5:ka_lain_volume,item6:sharing_pendapatan});
        }else{
          var pendapatan_barang=x;
          var volume_barang=y
        }

        //console.log(data);
        awal=sekarang;
        z++;
        if(barang[i].jenis=='Petikemas'){
          var petikemas_pendapatan=barang[i].pendapatan;
          var petikemas_volume=barang[i].volume;
        }else if(barang[i].jenis=='Semen'){
          var semen_pendapatan=barang[i].pendapatan;
          var semen_volume=barang[i].volume;
        }else if(barang[i].jenis=='BBM'){
          var bbm_pendapatan=barang[i].pendapatan;
          var bbm_volume=barang[i].volume;
        }else if(barang[i].jenis=='Cargo'){
          var cargo_pendapatan=barang[i].pendapatan;
          var cargo_volume=barang[i].volume;
        }else if(barang[i].jenis=='Ka Lain'){
          var ka_lain_pendapatan=barang[i].pendapatan;
          var ka_lain_volume=barang[i].volume;
        }else if(barang[i].jenis=='Sharing'){
          var sharing_pendapatan=barang[i].pendapatan;
        }
      }
    }
   	var area = new Morris.Area({
         element: 'pendapatan-barang',
         resize: true,
         data: pendapatan_barang,
         xkey: 'y',
         ykeys: ['item1', 'item2','item3','item4','item5','item6'],
         labels: ['Petikemas', 'Semen','BBM','Cargo','KA Lain','Sharing'],
         lineColors: ['#F44336', '#3F51B5','#9C27B0','#607D8B','#34495e','#3498db'],
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

   	var area = new Morris.Area({
         element: 'volume-barang',
         resize: true,
         data:volume_barang,
         xkey: 'y',
         ykeys: ['item1', 'item2','item3','item4','item5'],
         labels: ['Petikemas', 'Semen','BBM','Cargo','KA Lain'],
         lineColors: ['#F44336', '#3F51B5','#9C27B0','#607D8B','#34495e'],
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

     var nonangkutan = <?php echo json_encode($nonangkutan)?>;

     for (var i = 0; i < nonangkutan.length; i++) {
      x=[{y: nonangkutan[i]['created_at'], item1: nonangkutan[i]['pa'], item3: nonangkutan[i]['ambarawa'], item2: nonangkutan[i]['lawang'], item4: nonangkutan[i]['uuk']}]
      if(i!=0){
        non_angkutan.push({y: nonangkutan[i]['created_at'], item1: nonangkutan[i]['pa'], item3: nonangkutan[i]['ambarawa'], item2: nonangkutan[i]['lawang'], item4: nonangkutan[i]['uuk']});
      }else{
        var non_angkutan=x;
      }
     }
   	var area = new Morris.Area({
         element: 'non-angkutan',
         resize: true,
         data:non_angkutan,
         xkey: 'y',
         ykeys: ['item1', 'item2','item3','item4'],
         labels: ['PDDM','Lawang Sewu', 'Ambarawa','UUK'],
         lineColors: ['#F44336', '#3F51B5','#9C27B0','#607D8B'],
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
