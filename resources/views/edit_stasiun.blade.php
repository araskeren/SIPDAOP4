@extends('template.master')

@section('judulhalaman','Tabel stasiun')
@section('judulpage','Edit Stasiun')
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

         <div class="box-body">
            <form class="form-horizontal" action="{{ URL('/stasiun/edit') }}" class="form-horizontal" method="post">
              <div class="form-group">
                 <label for="inputStasiun4" class="col-sm-4 control-label">Nama Stasiun</label>
                 <div class="col-sm-7">
                   <input type="text" class="form-control" id="namaStasiun" name="namaStasiun" placeholder="nama stasiun" value="{{$data_stasiun->nama_stasiun}}">
                 </div>
               </div>
              <div class="form-group">
                <label for="inputStasiun4" class="col-lg-4 control-label"> Stasiun Barang?</label>
                <div class="col-lg-8">
                 @if($data_stasiun->stasiun_barang==1)
                 <label>
                   <input type="radio" name="stasiun_barang" class="flat-red" value="1" checked>
                   Ya
                 </label>
                 <label>
                   <input type="radio" name="stasiun_barang" value="0" class="flat-red" >
                   Tidak
                 </label>
                 @else
                 <label>
                   <input type="radio" name="stasiun_barang" class="flat-red" value="1">
                   Ya
                 </label>
                 <label>
                   <input type="radio" name="stasiun_barang" value="0" class="flat-red" checked>
                   Tidak
                 </label>

                 @endif

               </div>
             </div>
             <div class="form-group">
               <label for="stasiun_penumpang" class="col-lg-4 control-label"> Stasiun Penumpang ?</label>
               <div class="col-lg-8">
                @if($data_stasiun->stasiun_penumpang==1)
                <label>
                  <input type="radio" name="stasiun_penumpang" class="flat-red" value="1" checked>
                  Ya
                </label>
                <label>
                  <input type="radio" name="stasiun_penumpang" value="0" class="flat-red" >
                  Tidak
                </label>
                @else
                <label>
                  <input type="radio" name="stasiun_penumpang" class="flat-red" value="1">
                  Ya
                </label>
                <label>
                  <input type="radio" name="stasiun_penumpang" value="0" class="flat-red" checked>
                  Tidak
                </label>
                @endif
              </div>
            </div>
            @if(Auth::user()->level==1)
             {{csrf_field()}}
             <input type="hidden" name="id" value="{{$data_stasiun->id}}">
              <button type="submit" class="btn btn-info pull-right">Simpan</button>
              @endif
            </form>
         </div>
       </div>
     </div>

     <div class="col-lg-7">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">
           <h3 class="box-title">List Stasiun</h3>
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
                       <form action="/stasiun/cektombol" method="post">
                         {{csrf_field()}}
                         <input type="hidden" name="id" value="{{$i->id}}">
                         <button type="submit" class="btn-info" name="lihat" value="1">Lihat</button>
                         <button type="submit" class="btn-primary"name="edit" value="1">Edit</button>
                         <button type="submit" class="btn-danger"name="delete" value="1">Delete</button>
                       </form>
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
