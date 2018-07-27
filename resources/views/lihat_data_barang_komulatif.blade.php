@extends('template.master')

@section('judulhalaman',' Komulatif Barang')
@section('judulpage')
  <h1> Komulatif Barang<small>{{tanggal_indo($tanggal,true)}}</small></h1>
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
    <div class="col-lg-5">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">

        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th>Jenis</th>
                <td align=right><b>Pendapatan</b></td>
              </tr>
              @if(count($data_komulatif_barang)>0)
              <?php
                $total_pendapatan=0;
                foreach ($data_komulatif_barang as $i) {
                  $total_pendapatan+=$i->pendapatan;
                }
              ?>
              <tr>
                <td>Petikemas</td>
                <td align=right>Rp.{{number_format($data_komulatif_barang[2]->pendapatan,2,',','.')}}</td>
              </tr>
              <tr>
                <td>Semen</td>
               <td align=right>Rp.{{number_format($data_komulatif_barang[1]->pendapatan,2,',','.')}}</td>
              </tr>
              <tr>
                <td>BBM</td>
                <td align=right>Rp.{{number_format($data_komulatif_barang[0]->pendapatan,2,',','.')}}</td>
              </tr>
              <tr>
                <td>Cargo</td>
                <td align=right>Rp.{{number_format($data_komulatif_barang[3]->pendapatan,2,',','.')}}</td>
              <tr>
                <td>Pendapatan_lain</td>
                <td align=right>Rp.{{number_format($data_komulatif_barang[4]->pendapatan,2,',','.')}}</td>
              </tr>
              <tr>
                <td>Pendapatan_sharing</td>
                <td align=right>Rp.{{number_format($data_komulatif_barang[5]->pendapatan,2,',','.')}}</td>
              </tr>

              <tr>
                <th>Jumlah</th>
                <td align=right><b>Rp.{{number_format($total_pendapatan,2,',','.')}} <span class="badge bg-red">{{number_format(persentase($total_pendapatan,$target_barang->pendapatan),2,'.',',')}} %</span></b></td>
              </tr>
              <tr>
                <th>Target Pendapatan</th>
                <td align=right><b>Rp.{{number_format($target_barang->pendapatan,2,',','.')}}</b></td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title">Tabel Komulatif Pendukung</h3>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody>
              <tr>
                <th>Jenis</th>
                <td align=right><b>Volume</b></td>
              </tr>
              @if(count($data_komulatif_barang)>0)
              <tr>
                <td>Petikemas</td>
                <td align=right>{{number_format($data_komulatif_barang[2]->volume,0,',','.')}}(Ton)</td>
              </tr>
              <tr>
                <td>Semen</td>
                <td align=right>{{number_format($data_komulatif_barang[1]->volume,0,',','.')}}(Ton) </td>
              </tr>
              <tr>
                <td>BBM</td>
                <td align=right>{{number_format($data_komulatif_barang[0]->volume,0,',','.')}}(L) </td>
              </tr>
              <tr>
                <td>Cargo</td>
                <td align=right>0</td>
              </tr>
              <tr>
                <td>Pendapatan_lain</td>
                <td align=right>0</td>
              </tr>
              <tr>
                <td>Pendapatan_sharing</td>
                <td align=right>0</td>
              </tr>
              @if($data_komulatif_bhp!=null)
              <tr>
                <td>BHP</td>
                <td align=right>{{number_format($data_komulatif_bhp->value,0,',','.')}}(Kg) </td>
              </tr>
              @else
              <tr>
                <td>BHP</td>
                <td align=right>Tidak ada data !</td>
              </tr>
              @endif
              @endif
            </tbody>
          </table>
        </div>
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

 <script src="{!!asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')!!}"></script>
 <!-- bootstrap datepicker -->
 <script src="{!!asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')!!}"></script>

 <!-- DataTables -->
 <script src="{!!asset('bower_components/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
 <script src="{!!asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}"></script>

 <!-- page script -->
 <script>
   $(function () {
     $('#data-penumpang').DataTable({
       'paging'      : true,
       'lengthChange': true,
       'searching'   : true,
       'ordering'    : true,
       'info'        : true,
       'autoWidth'   : false,
       'scrollY'     : '270px',
       'scrollCollapse': true,
     })
   })
   </script>
@endsection
