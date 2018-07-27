@extends('template.master')

@section('judulhalaman','Welcome')
@section('judulpage')
<h1>Selamat Datang User {{Auth::user()->name}}</h1>
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
  @if(Auth::user()->level==2)
    <div class="col-lg-6">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Eksekutif</h3>
        </div>
        <div class="box-body">
          <table class="table table-hover">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Volume</th>
            <th>Pendapatan</th>
            <th>X^2</th>
            <th>Y^2</th>
            <th>XY</th>
          </tr>
          <?php
          $total_volume=0;
          $total_pendapatan=0;
          $total_xy=0;
          $total_x2=0;
          $total_y2=0;
          $jumlahdata=0;
           ?>
          @foreach($data as $i)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$i->created_at}}</td>
            <td>{{$i->volume}}</td>
            <td>{{$i->pendapatan}}</td>
            <td>{{$x2=$i->volume^2}}</td>
            <td>{{$y2=$i->pendapatan^2}}</td>
            <td>{{$xy=$i->volume*$i->pendapatan}}</td>
          </tr>
          <?php
          $total_volume+=$i->volume;
          $total_pendapatan+=$i->pendapatan;
          $total_xy+=$xy;
          $total_x2+=$x2;
          $total_y2+=$y2;
          $jumlahdata++;
           ?>
          @endforeach

          <tr>
            <td>#</td>
            <td>Total</td>
            <td>{{$total_volume}}</td>
            <td>{{$total_pendapatan}}</td>
            <td>{{$total_x2}}</td>
            <td>{{$total_y2}}</td>
            <td>{{number_format($total_xy)}}</td>
          </tr>
          <tr>
            <td>#</td>
            <td>Rata-Rata</td>
            <td>{{$ratavolume=$total_volume/$jumlahdata}}</td>
            <td>{{$ratapendapatan=$total_pendapatan/$jumlahdata}}</td>
          </tr>
        </table>
        <p>
          <b>A={{$A=(($total_pendapatan*$total_x2)-($total_volume*$total_xy))/(($jumlahdata*$total_x2)-pow($total_volume,2))}}</b><br>
          <b>B={{$B=(($jumlahdata*$total_xy)-($total_volume*$total_pendapatan))/(($jumlahdata*$total_x2)-pow($total_volume,2))}}</b><br>
          <b>Y={{number_format($A)}}+{{number_format($B)}}*X</b><br>
          @php($volume=1557)
          <b>Contoh : Prediksi Jumlah Pendapatan Penumpang Exsekutif berdasarkan Volume Penumpang : {{$volume}}</b><br>
          <b>Jawab : {{number_format($A+$B*$volume)}}</b>
        </p>
        </div>
      </div>
    </div>
  @endif
@endsection

@section('scripttambahan')
<!--
  Tempatnya Script tambahan
  Formatnya :
  <script src="{!! asset('path') !!}"></script>
 -->

@endsection
