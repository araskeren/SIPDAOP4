@extends('template.master')

@section('judulhalaman','Tambah User')
@section('judulpage')
  <h1>Tambah User</h1>
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

@endsection
@section('konten')
  <!-- Tempatnya Konten -->
   <div class="row">
     <div class="col-lg-5">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">
           <h3 class="box-title">Daftar</h3>
         </div>
         <form action="user/tambah" class="form-horizontal" method="post">
         <div class="box-body">
             <div class="form-group">
                 <label for="username" class="col-sm-2 control-label">Nama</label>
                 <div class="col-sm-10">
                 <input type="text" class="form-control" name="nama" placeholder="Nama">
                 </div>
             </div>
             <div class="form-group">
                 <label for="username" class="col-sm-2 control-label">Username</label>
                 <div class="col-sm-10">
                 <input type="text" class="form-control" name="username" placeholder="username">
                 </div>
             </div>
             <div class="form-group">
                 <label for="Email" class="col-sm-2 control-label">Email</label>
                 <div class="col-sm-10">
                 <input type="Email" class="form-control" name="email" placeholder="email">
                 </div>
             </div>
             <div class="form-group">
                 <label for="password" class="col-sm-2 control-label">Password</label>
                 <div class="col-sm-10">
                 <input type="password" class="form-control" name="password" placeholder="password">
                 </div>
             </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">Level</label>
                <div class="col-lg-10">
                 <select class="form-control select2" style="width: 100%;" name="level">
                   <option selected="selected" readonly>Pilih Hak Akses</option>
                   <option value="2">User-Penumpang</option>
                   <option value="3">User-Barang</option>
                   <option value="8">User-PA</option>
                   <option value="4">User-PDDM</option>
                   <option value="5">User-Lawang-Sewu</option>
                   <option value="6">User-Ambarawa</option>
                   <option value="7">User-UUK</option>
				   <option value="9">User-Pusdal</option>
				   <option value="10">User-KA-Daop4</option>
                   <option value="1">Admin</option>
                 </select>
                 </div>
               </div >
           </div>
		@if(Auth::user()->level==1)
		  {{csrf_field()}}
         <div class="box-footer">
             <button type="submit" class="btn btn-info pull-right">Tambah User</button>
         </div>
		@endif
         </form>
       </div>
     </div>
     <div class="col-lg-7">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">
           <h3 class="box-title">Daftar User</h3>
         </div>
         <div class="box-body">
             <table id="daftar-user" class="table table-bordered table-striped">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Username</th>
                         <th>Email</th>
                         <th>Role</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 @foreach($data_user as $i)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$i->username}}</td>
                     <td>{{$i->email}}</td>
                     @if($i->level==1)
                     <td>Administrator</td>
                     @elseif($i->level==2)
                     <td>User-Penumpang</td>
                     @elseif($i->level==3)
                     <td>User-Barang</td>
                     @elseif($i->level==4)
                     <td>User-PDDM</td>
                     @elseif($i->level==5)
                     <td>User-Lawang-Sewu</td>
                     @elseif($i->level==6)
                     <td>User-Ambarawa</td>
                     @elseif($i->level==7)
                     <td>User-UUK</td>
                     @elseif($i->level==8)
                     <td>User-PA</td>
					 @elseif($i->level==9)
                     <td>User-Pusdal</td>
					 @elseif($i->level==10)
                     <td>User-KA-Daop4</td>
                     @endif
                     <td>
                    @if(Auth::user()->level==1)
					<form action="/user/cektombol" method="post">
                       {{csrf_field()}}
                       <input type="hidden" name="id" value="{{$i->id}}">
                       <button type="submit" class="btn-primary" name="edit"value="1">Edit</button>
                       <button type="submit" class="btn-danger" name="delete" value="1">Delete</button>
                     </form>
					@endif
                     </td>
                 </tr>
                 @endforeach
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
 <!-- Select2 -->
 <script src="{!!asset('bower_components/select2/dist/js/select2.full.min.js')!!}"></script>

 <!-- DataTables-->
 <script src="{!!asset('bower_components/datatables.net/js/jquery.dataTables.min.js')!!}"></script>
 <script src="{!!asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')!!}"></script>
 <script>
 $(function () {
   $('#daftar-user').DataTable({
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
</script>
@endsection
