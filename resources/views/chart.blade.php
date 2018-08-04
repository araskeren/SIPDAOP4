@extends('template.master')

@section('judulhalaman','Judul Halaman')
@section('judulpage','Chart')
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
  $(function () {
    "use strict";

    // AREA CHART
    var area = new Morris.Area({
      element: 'pendapatan-penumpang',
      resize: true,
      data: [
        {y: '2018-08-01', item1: 107605000, item2: 581271494, item3: 295076738, item4: 465795661},
        {y: '2018-08-02', item1: 207605000, item2: 457359706, item3: 503616962, item4: 158594905},
        {y: '2018-08-03', item1: 307605000, item2: 607013396, item3: 799234958, item4: 216825031},
        {y: '2018-08-04', item1: 407605000, item2: 519944389, item3: 369688964, item4: 736426330},
        {y: '2018-08-05', item1: 507605000, item2: 832045297, item3: 456937565, item4: 145931029},
        {y: '2018-08-06', item1: 607605000, item2: 221522498, item3: 214442225, item4: 716071542},
        {y: '2018-08-07', item1: 707605000, item2: 878763692, item3: 785579225, item4: 352263193},
        {y: '2018-08-08', item1: 807605000, item2: 526648257, item3: 268501502, item4: 154232852},
        {y: '2018-08-09', item1: 907605000, item2: 292679829, item3: 521054085, item4: 851374013},
        {y: '2018-08-10', item1: 107605000, item2: 760020772, item3: 608871809, item4: 615998999}
      ],
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
      data: [
        {y: '2018-08-01', item1: 663900, item2: 263847, item3: 263847, item4: 139230},
        {y: '2018-08-02', item1: 718089, item2: 368002, item3: 718089, item4: 663900},
        {y: '2018-08-03', item1: 231551, item2: 535958, item3: 535958, item4: 231551},
        {y: '2018-08-04', item1: 504441, item2: 367922, item3: 508355, item4: 535958},
        {y: '2018-08-05', item1: 508355, item2: 805644, item3: 812886, item4: 368002},
        {y: '2018-08-06', item1: 281333, item2: 285184, item3: 663900, item4: 148818},
        {y: '2018-08-07', item1: 812886, item2: 194961, item3: 148818, item4: 263847},
        {y: '2018-08-08', item1: 148818, item2: 145722, item3: 528412, item4: 145722},
        {y: '2018-08-09', item1: 528412, item2: 186575, item3: 186575, item4: 186575},
        {y: '2018-08-10', item1: 139230, item2: 107037, item3: 145722, item4: 107037}
      ],
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
      element: 'pendapatan-barang',
      resize: true,
      data: [
        {y: '2018-08-01', item1: 22695113, item2: 20753694, item3: 42311721, item4: 54777531,item5:30527479,item6:15279347},
        {y: '2018-08-02', item1: 32525353, item2: 27628788, item3: 45274269, item4: 34527747,item5:68748012,item6:18883231},
        {y: '2018-08-03', item1: 54800947, item2: 33816538, item3: 15210594, item4: 63789146,item5:64126390,item6:49283168},
        {y: '2018-08-04', item1: 30826808, item2: 24442626, item3: 53888575, item4: 21258020,item5:66203342,item6:27677376},
        {y: '2018-08-05', item1: 32637909, item2: 47499334, item3: 59749203, item4: 31352054,item5:53473617,item6:36922518},
        {y: '2018-08-06', item1: 16467063, item2: 57739022, item3: 47436366, item4: 44201780,item5:49176327,item6:68641103},
        {y: '2018-08-07', item1: 12991424, item2: 24974075, item3: 13962706, item4: 38050387,item5:42270238,item6:51500273},
        {y: '2018-08-08', item1: 44291708, item2: 32957869, item3: 64261482, item4: 26655357,item5:19576311,item6:66951831},
        {y: '2018-08-09', item1: 58790839, item2: 33063167, item3: 21975780, item4: 39885916,item5:30979472,item6:51573630},
        {y: '2018-08-10', item1: 54127956, item2: 31839848, item3: 16756988, item4: 57937125,item5:41349229,item6:19478995}
      ],
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
      data: [
        {y: '2018-08-01', item1: 107605000, item2: 581271494, item3: 295076738, item4: 465795661,item5: 465795661},
        {y: '2018-08-02', item1: 207605000, item2: 457359706, item3: 503616962, item4: 158594905,item5: 465795661},
        {y: '2018-08-03', item1: 307605000, item2: 607013396, item3: 799234958, item4: 216825031,item5: 465795661},
        {y: '2018-08-04', item1: 407605000, item2: 519944389, item3: 369688964, item4: 736426330,item5: 465795661},
        {y: '2018-08-05', item1: 507605000, item2: 832045297, item3: 456937565, item4: 145931029,item5: 465795661},
        {y: '2018-08-06', item1: 607605000, item2: 221522498, item3: 214442225, item4: 716071542,item5: 465795661},
        {y: '2018-08-07', item1: 707605000, item2: 878763692, item3: 785579225, item4: 352263193,item5: 465795661},
        {y: '2018-08-08', item1: 807605000, item2: 526648257, item3: 268501502, item4: 154232852,item5: 465795661},
        {y: '2018-08-09', item1: 907605000, item2: 292679829, item3: 521054085, item4: 851374013,item5: 465795661},
        {y: '2018-08-10', item1: 107605000, item2: 760020772, item3: 608871809, item4: 615998999,item5: 465795661}
      ],
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
	
	var area = new Morris.Area({
      element: 'non-angkutan',
      resize: true,
      data: [
        {y: '2018-08-01', item1: 22695113, item2: 20753694, item3: 42311721, item4: 54777531,item5:30527479},
        {y: '2018-08-02', item1: 32525353, item2: 27628788, item3: 45274269, item4: 34527747,item5:68748012},
        {y: '2018-08-03', item1: 54800947, item2: 33816538, item3: 15210594, item4: 63789146,item5:64126390},
        {y: '2018-08-04', item1: 30826808, item2: 24442626, item3: 53888575, item4: 21258020,item5:66203342},
        {y: '2018-08-05', item1: 32637909, item2: 47499334, item3: 59749203, item4: 31352054,item5:53473617},
        {y: '2018-08-06', item1: 16467063, item2: 57739022, item3: 47436366, item4: 44201780,item5:49176327},
        {y: '2018-08-07', item1: 12991424, item2: 24974075, item3: 13962706, item4: 38050387,item5:42270238},
        {y: '2018-08-08', item1: 44291708, item2: 32957869, item3: 64261482, item4: 26655357,item5:19576311},
        {y: '2018-08-09', item1: 58790839, item2: 33063167, item3: 21975780, item4: 39885916,item5:30979472},
        {y: '2018-08-10', item1: 54127956, item2: 31839848, item3: 16756988, item4: 57937125,item5:41349229}
      ],
      xkey: 'y',
      ykeys: ['item1', 'item2','item3','item4'],
      labels: ['PDDM', 'Ambarawa','Lawang Sewu','UUK'],
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
