@extends('template.master')

@section('judulhalaman','Tambah User')
@section('judulpage')
  <h1>Edit User</h1>
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
           <h3 class="box-title">Edit Data User {{$user->name}}</h3>
         </div>
         <form action="edited" class="form-horizontal" method="post">
          {{csrf_field()}}
          <input type="hidden" name="id" value="{{$user->id}}">
         <div class="box-body">
             <div class="form-group">
                 <label for="username" class="col-sm-2 control-label">Nama</label>
                 <div class="col-sm-10">
                 <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{$user->name}}">
                 </div>
             </div>
             <div class="form-group">
                 <label for="username" class="col-sm-2 control-label">Username</label>
                 <div class="col-sm-10">
                 <input type="text" class="form-control" name="username" placeholder="username" value="{{$user->username}}">
                 </div>
             </div>
             <div class="form-group">
                 <label for="Email" class="col-sm-2 control-label">Email</label>
                 <div class="col-sm-10">
                 <input type="Email" class="form-control" name="email" placeholder="email" value="{{$user->email}}">
                 </div>
             </div>
             <div class="form-group">
                 <label for="password" class="col-sm-2 control-label">Password</label>
                 <div class="col-sm-10">
                 <input type="password" class="form-control" name="password" placeholder="password" >
                 </div>
             </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">Level</label>
                <div class="col-lg-10">
                 <select class="form-control select2" style="width: 100%;" name="level">
                   <option selected="selected" readonly>Pilih Hak Akses</option>
                   @if($user->level==2)
                   <option value="2" selected>User-Penumpang</option>
                   @else
                   <option value="2">User-Penumpang</option>
                   @endif
                   @if($user->level==3)
                   <option value="3" selected>User-Barang</option>
                   @else
                   <option value="3">User-Barang</option>
                   @endif
                   @if($user->level==8)
                   <option value="8" selected>User-PA</option>
                   @else
                   <option value="8">User-PA</option>
                   @endif
                   @if($user->level==4)
                   <option value="4" selected>User-PDDM</option>
                   @else
                   <option value="4">User-PDDM</option>
                   @endif
                   @if($user->level==5)
                   <option value="5" selected>User-Lawang-Sewu</option>
                   @else
                   <option value="5">User-Lawang-Sewu</option>
                   @endif
                   @if($user->level==6)
                   <option value="6" selected>User-Ambarawa</option>
                   @else
                   <option value="6">User-Ambarawa</option>
                   @endif
                   @if($user->level==7)
                   <option value="7" selected>User-UUK</option>
                   @else
                   <option value="7">User-UUK</option>
                   @endif
				   @if($user->level==9)
                   <option value="9" selected>User-Pusdal</option>
                   @else
                   <option value="9">User-Pusdal</option>
                   @endif
				   @if($user->level==10)
                   <option value="10" selected>User-KA-Daop4</option>
                   @else
                   <option value="10">User-KA-Daop4</option>
                   @endif
                   @if($user->level==1)
                   <option value="1" selected>Admin</option>
                   @else
                   <option value="1">Admin</option>
                   @endif
                 </select>
                 </div>
               </div >
           </div>
         <div class="box-footer">
             <button type="submit" class="btn btn-primary pull-right">Update User</button>
         </div>
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
                     <td>User-PA</td>
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
                     <form action="/user/cektombol" method="post">
                       {{csrf_field()}}
                       <input type="hidden" name="id" value="{{$i->id}}">
                       <button type="submit" class="btn-primary" name="edit"value="1">Edit</button>
                       <button type="submit" class="btn-danger" name="delete" value="1">Delete</button>
                     </form>
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
