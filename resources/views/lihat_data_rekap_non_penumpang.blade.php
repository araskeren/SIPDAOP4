@extends('template.master')

@section('judulhalaman','Pendapatan Harian Non Angkutan')
@section('judulpage')
  <h1>Pendapatan Harian Non Angkutan <small>{{tanggal_indo($tanggal,true)}}</small></h1>
@endsection
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->
 <!-- Select2 -->
 <link rel="stylesheet" href="{!!asset('bower_components/select2/dist/css/select2.min.css')!!}">

 <!-- DataTables -->
 <link rel="stylesheet" href="{!!asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')!!}">
 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="{!!asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')!!}">

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="col-lg-8">
   <!-- Koding disini -->
     <div class="row">
       <div class="box box-default color-palette-box">
          <div class="box-header with-border">
            <form action="" method="post">
              <div class="col-lg-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tanggal" placeholder="Pilih Tanggal" value="">
                </div>
              </div>
              {{csrf_field()}}
              <div class="col-lg-3">
                <input type="submit" class="btn btn-block btn-primary" value="Pilih">
              </div>
            </form>
              <div class="col-lg-3">
              @if(Auth::user()->level==4)
              <form class="" action="cektombolpa" method="post">
                <input type="hidden" name="tanggal" value="{{$tanggal}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-block btn-success" name="edit" value="1">Edit</button>
              </form>
              @elseif(Auth::user()->level==5)
              <form class="" action="cektombollawang" method="post">
                <input type="hidden" name="tanggal" value="{{$tanggal}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-block btn-success" name="edit" value="1">Edit</button>
              </form>
              @elseif(Auth::user()->level==6)
              <form class="" action="cektombolambarawa" method="post">
                <input type="hidden" name="tanggal" value="{{$tanggal}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-block btn-success" name="edit" value="1">Edit</button>
              </form>
              @elseif(Auth::user()->level==7)
              <form class="" action="cektomboluuk" method="post">
                <input type="hidden" name="tanggal" value="{{$tanggal}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-block btn-success" name="edit" value="1">Edit</button>
              </form>
              @endif
            </div>
          </div>
       <div class="box box-default color-palette-box">
         <div class="box-body">
           <div class="box-body table-responsive no-padding">
           <table class="table table-hover">
             <tbody>
               <tr>
                 <th>No</th>
                 <th>Jenis</th>
                 <td align=right><b>Pendapatan</b></td>
                 <td align=right><b>Komulatif</b></td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Pendapatan PDDM</td>
                  <td align='right'>Rp.{{number_format($total_pendapatan_pa,2,',','.')}}</td>
                  @php($total_komulatif=0)
                  @if($data_komulatif_non!=null)
                    @foreach($data_komulatif_non as $i)
                      @if($i->jenis=='PDDM')
                      <td align='right'>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
                      @php($total_komulatif+=$i->pendapatan)
                      <?php break; ?>
                      @endif
                    @endforeach
                  @endif
                </tr>
                <tr>
                <td>2</td>
                <td>Pendapatan Lawang Sewu</td>
                <td align='right'>Rp.{{number_format($total_pendapatan_lawang,2,',','.')}}</td>
                @if($data_komulatif_non!=null)
                  @foreach($data_komulatif_non as $i)
                    @if($i->jenis=='Lawang')
                    <td align='right'>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
                    @php($total_komulatif+=$i->pendapatan)
                    <?php break; ?>
                    @endif
                  @endforeach
                @endif
              </tr>
                <tr>
                  <td>3</td>
                  <td>Pendapatan Ambarawa</td>
                  <td align='right'>Rp.{{number_format($total_pendapatan_ambarawa,2,',','.')}}</td>
                  @if($data_komulatif_non!=null)
                    @foreach($data_komulatif_non as $i)
                      @if($i->jenis=='Ambarawa')
                      <td align='right'>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
                      @php($total_komulatif+=$i->pendapatan)
                      <?php break; ?>
                      @endif
                    @endforeach
                  @endif
                </tr>
                <tr>
                  <td>4</td>
                  <td>Pendapatan UUK</td>
                  <td align='right'>Rp.{{number_format($total_pendapatan_uuk,2,',','.')}}</td>
                  @if($data_komulatif_non!=null)
                    @foreach($data_komulatif_non as $i)
                      @if($i->jenis=='UUK')
                      <td align='right'>Rp.{{number_format($i->pendapatan,2,',','.')}}</td>
                      @php($total_komulatif+=$i->pendapatan)
                      <?php break; ?>
                      @endif
                    @endforeach
                  @endif
                </tr>
                <tr>
                   <th></th>
                   <th>Jumlah</th>
                   <td align=right><b>Rp.{{number_format($total_pendapatan,2,',','.')}}</b></td>
                   <td align=right><b>Rp.{{number_format($total_komulatif,2,',','.')}}</b></td>
                 </tr>
                <tr>
                 <th></th>
                 <th>Target</th>
                 <th></th>
                 <td align=right><b>Rp.{{number_format($target_non->pendapatan,2,',','.')}}</b></td>
                </tr>
                <tr>
                  <th></th>
                  <th>Persentase</th>
                  <th></th>
                  <td align=right><span class="badge bg-red">{{number_format(persentase($total_komulatif,$target_non->pendapatan),2,'.',',')}} %</span></td>
                </tr>
             </tbody>
           </table>
         </div>
         </div>
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
 <!-- Select2 -->
 <script src="{!!asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>
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
     $('.select2').select2()
   });
   $(document).ready(function () {
       $('#datepicker').datepicker({
         locale: 'id',
         autoclose:true,
         format:'dd-mm-yyyy'
       });
   });
 </script>
@endsection
