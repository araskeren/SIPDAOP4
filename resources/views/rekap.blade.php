@extends('template.master')

@section('judulhalaman','Rekap Keseluruhan Komulatif')
@section('judulpage')
<h1>
  <b>
  Informasi Rekapitulasi Komulatif
  </b>
</h1>
@endsection
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
@endsection
@section('konten')
  <!-- Tempatnya Konten -->

  <div class="row">
    <div class="col-lg-4">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Laporan Pendapatan</h3>
          <div class="box-tools">
           <a href="rekap_harian.html"><button type="button" class="btn btn-block btn-success">Detail</button></a>

          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th style="width: 10px">#</th>
              <th>Jenis</th>
              <th>Volume</th>
            </tr>
            <tr>
              <td>1.</td>
              <td>Penumpang</td>
              <td>Rp.1.255.451.000,00</td>
            </tr>
            <tr>
              <td>2.</td>
              <td>Barang</td>
              <td>Rp.222.937.265,00</td>
            </tr>
            <tr>
              <td>3.</td>
              <td>Non Angkutan</td>
              <td>Rp.60.115.662,00</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td>Total</td>
              <td>Rp.1.538.503.927,00</td>
            </tr>
          </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-lg-8">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Progress Komulatif</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
              <th>Target Tahun 2018</th>
              <th>Progress</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Penumpang</td>
              <td>Rp.107.667.600.500,00</td>
              <td>Rp.633.828.175.000,00</td>
              <td><span class="badge bg-blue">16.99%</span></td>
            </tr>

    <tr>
              <td>2</td>
              <td>Barang</td>
              <td>Rp.123.039.243.754,00</td>
              <td>Rp.733.027.055.033,00</td>
              <td><span class="badge bg-blue">16.79%</span></td>
            </tr>

    <tr>
              <td>3</td>
              <td>Non_Angkutan</td>
              <td>Rp.9.139.288.129,00</td>
              <td>Rp.80.015.000.000,00</td>
              <td><span class="badge bg-blue">11.49%</span></td>
            </tr>

            <tr>
              <td>#</td>
              <td><b>Jumlah</b></td>
              <td><b>Rp.132.232.531.883,00</b></td>
              <td><b>Rp.813.042.055.033,00</b></td>
              <td><span class="badge bg-red">20%</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <div>
    <h3>
      <b>
      Informasi Rincian Keseluruhan Bagian Komulatif
    </b>
  </h3>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Pendapatan Penumpang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
              <th>Target Tahun 2018</th>
              <th>Progress</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              <td>Rp.40.988.314.000,00</td>
              <td>Rp.233.330.894.000,00</td>
              <td><span class="badge bg-blue">17.57%</span></td>
            </tr>

    <tr>
              <td>2</td>
              <td>Bisnis</td>
              <td>Rp.4.518.310.000,00</td>
              <td>Rp.28.342.621.000,00</td>
              <td><span class="badge bg-blue">15.94%</span></td>
            </tr>

    <tr>
              <td>3</td>
              <td>Ekonomi</td>
              <td>Rp.48.396.336.500,00</td>
              <td>Rp.301.214.873.000,00</td>
              <td><span class="badge bg-blue">16.07%</span></td>
            </tr>

    <tr>
              <td>4</td>
              <td>Lokal</td>
              <td>Rp.13.764.640.000,00</td>
              <td>Rp.70.939.787.000,00</td>
              <td><span class="badge bg-blue">19.40%</span></td>
            </tr>
            <tr>
              <td>#</td>
              <td><b>Jumlah</b></td>
              <td><b>Rp.107.667.600.500,00</b></td>
              <td><b>Rp.633.828.175.000,00</b></td>
              <td><span class="badge bg-red">16.99%</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Volume Penumpang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>
              <th>Target Tahun 2018</th>
              <th>Progress</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Eksekutif</td>
              <td>143.749</td>
              <td>836.487</td>
              <td><span class="badge bg-blue">17.91%</span></td>
            </tr>

            <tr>
              <td>2</td>
              <td>Bisnis</td>
              <td>22.600</td>
              <td>165.345</td>
              <td><span class="badge bg-blue">13.67%</span></td>
            </tr>


            <tr>
              <td>3</td>
              <td>Ekonomi</td>
              <td>565.952</td>
              <td>3.011.362</td>
              <td><span class="badge bg-blue">18.79%</span></td>
            </tr>

            <tr>
              <td>4</td>
              <td>Lokal</td>
              <td>344.395</td>
              <td>2.018.263</td>
              <td><span class="badge bg-blue">17.06%</span></td>
            </tr>

            <tr>
              <td>#</td>
              <td><b>Jumlah</b></td>
              <td><b>1.082.740</b></td>
              <td><b>6.031.457</b></td>
              <td><span class="badge bg-red">17.95%</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Pendapatan Barang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>

            </tr>
            <tr>
              <td>1</td>
              <td>Petikemas</td>
              <td>Rp.9.480.000,00</td>
            </tr>

            <tr>
              <td>2</td>
              <td>Semen</td>
                <td>Rp.12.246.062,00</td>
            </tr>

            <tr>
              <td>3</td>
              <td>BBM</td>
              <td>Rp.30.339.399,00</td>

            </tr>

            <tr>
              <td>4</td>
              <td>Cargo</td>
              <td>Rp.2.200.000,00</td>

            </tr>

            <tr>
              <td>5</td>
              <td>Pendapatan Ka Lain</td>
              <td>Rp.-</td>

            </tr>

            <tr>
              <td>6</td>
              <td>Pendapatan Sharing</td>
              <td>Rp.168.671.804,00</td>

            </tr>

            <tr>
              <td>#</td>
              <td><b>Jumlah</b></td>
              <td><b>Rp.15.371.643.254,00</b></td>


            </tr>

            <tr>
                <td>#</td>
                <td><b>Target Tahun 2018</b></td>
                <td><b>Rp.99.198.880.033,00</b></td>
            </tr>

            <tr>
                 <td>#</td>
                 <td><b>Progress</b></td>
                 <td><span class="badge bg-red">-%</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Pendukung Laporan Barang</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>

            </tr>
            <tr>
              <td>1</td>
              <td>BBM</td>
              <td>1.816.335(L)</td>

            </tr>

            <tr>
              <td>2</td>
              <td>Semen</td>
              <td>600(Ton)</td>

            </tr>

            <tr>
              <td>3</td>
              <td>BHP</td>
              <td>10.983(Kg)</td>

            </tr>

            <tr>
              <td>#</td>
              <td><b>Jumlah</b></td>
              <td><b>15.371.643.254</b></td>

            </tr>

            <tr>
               <td>#</td>
                <td><b>Target Tahun 2018</b></th>
                <td><b>99.198.880.033</b></td>
            </tr>

            <tr>
            <td>#</td>
            <td><b>Progress</b></th>
            <td><span class="badge bg-red">15.50%</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Rincian Pendapatan Non Angkutan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tr>
              <th>#</th>
              <th>Jenis</th>
              <th>Komulatif</th>

            </tr>
            <tr>
              <td>1</td>
              <td>Pendapatan PA</td>
              <td>Rp.46.005.662,00</td>

            </tr>

            <tr>
              <td>2</td>
              <td>Musium Lawang Sewu</td>
              <td>Rp.10.825.000,00</td>

            </tr>

            <tr>
              <td>3</td>
              <td>Museum Ambarawa</td>
              <td>Rp.3.285.000,00</td>

            </tr>

            <tr>
              <td>4</td>
              <td>Sewa KA Ambarawa</td>
              <td>Rp.-,00</td>

            </tr>
            <tr>
              <td>#</td>
              <td><b>Jumlah</b></td>
              <td><b>Rp.9.139.288.129,00</b></td>


            </tr>

            <tr>
               <td>#</td>
                <td><b>Target Tahun 2018</b></td>
                <td><b>Rp.80.015.000.000,00</b></td>
            </tr>

            <tr>
               <td>#</td>
                <td><b>Progress</b></td>
                <td><span class="badge bg-red">11.49%</span></td>
            </tr>
          </table>
        </div>
        <!-- /.box-body -->
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

@endsection
