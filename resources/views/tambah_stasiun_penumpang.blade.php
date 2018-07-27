@extends('template.master')

@section('judulhalaman','Tabel stasiun Penumpang')
@section('judulpage','Tambah data stasiun Penumpang ')
@section('csstambahan')
<!--
  Tempatnya CSS tambahan
  Formatnya :
  <link rel="stylesheet" href="{!!asset('path') !!}">
 -->

 <!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="{!!asset('plugins/iCheck/all.css')!!}">
 <!-- Ionicons -->
 <link rel="stylesheet" href="{!!asset('bower_components/Ionicons/css/ionicons.min.css')!!}">
@endsection
@section('konten')
  <!-- Tempatnya Konten -->
  <div class="row">
     <div class="col-lg-5">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">
           <h3 class="box-title">Tambah Stasiun Penumpang</h3>
         </div>
         <div class="box-body">
            <form action=" " class="form-horizontal" method="post">
              <div class="form-group">
                 <label for="inputStasiun4" class="col-sm-4 control-label">Nama Stasiun</label>
                 <div class="col-sm-7">
                   <input type="text" class="form-control" id="namaStasiun" name="namaStasiun" placeholder="nama stasiun" value="">
                 </div>
               </div>
               @if(Auth::user()->level==2)
               {{csrf_field()}}
               <button type="submit" class="btn btn-info pull-right">Tambah</button>
               @endif
             </form>
          </div>
         </div>
       </div>

     <div class="col-lg-7">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">
           <h3 class="box-title">Daftar Stasiun Penumpang</h3>
         </div>

         <div class="box-body">
             <table id="daftar-stasiun" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Nama Stasiun</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                   @foreach($data as $i)
                   <tr>
                     <td>{{$loop->index+1}}</td>
                     <td>{{$i->nama_stasiun}}</td>
                     <td>
                         @if(Auth::user()->level==2)
                         <form action="/stasiun/penumpang/cektombol" method="post">
                         <input type="hidden" name="id" value="{{$i->id}}">
                         {{csrf_field()}}
                          @if($i->stasiun_penumpang==1)
                          <button type="submit" class="btn-danger" name="NonAktifkan" value="1">Non Aktifkan</button>
                          @else
                          <button type="submit" class="btn-primary" name="Aktifkan" value="1">Aktifkan</button>
                          @endif
                        </form>
                         @endif
                     </td>
                   </tr>
                   @endforeach
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
 <!-- iCheck 1.0.1 -->
 <script src="{!!asset('plugins/iCheck/icheck.min.js')!!}"></script>
 <!-- DataTables -->
 <script src="{!!asset('bower_components/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
 <script src="{!!asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}"></script>
<script>
$(function(){
  $('#daftar-stasiun').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'scrollY'     : '270px',
    'scrollCollapse': true,
  })

  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue',
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red',
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green',
    })


  });
</script>


@endsection
