@extends('template.master')

@section('judulhalaman','Daftar Username')
@section('judulpage')
  <h3> <b>Daftar username</b> </h3>
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
         <form action="" class="form-horizontal">
         <div class="box-body">
             <div class="form-group">
                 <label for="username" class="col-sm-2 control-label">Username</label>
                 <div class="col-sm-10">
                 <input type="text" class="form-control" id="username" placeholder="username">
                 </div>
             </div>
             <div class="form-group">
                 <label for="Email" class="col-sm-2 control-label">Email</label>
                 <div class="col-sm-10">
                 <input type="Email" class="form-control" id="Email" placeholder="email">
                 </div>
             </div>
             <div class="form-group">
                 <label for="password" class="col-sm-2 control-label">Password</label>
                 <div class="col-sm-10">
                 <input type="password" class="form-control" id="password" placeholder="password">
                 </div>
             </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">Role</label>
                <div class="col-lg-10">
                 <select class="form-control select2" style="width: 100%;">
                   <option selected="selected" disabled>Pilih Role</option>
                   <option>Admin</option>
                   <option>User BHP</option>
                   <option>User </option>
                 </select>
                 </div>
               </div >
           </div>
         <div class="box-footer">
             <button type="submit" class="btn btn-info pull-right">Tambah User</button>
         </div>
         </form>
       </div>
     </div>
     <div class="col-lg-7">
       <div class="box box-default color-palette-box">
         <div class="box-header with-border">
           <h3 class="box-title">List Stasiun</h3>
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
                     <td>1</td>
                     <td>{{$i->username}}</td>
                     <td>{{$i->email}}</td>
                     <td>user</td>
                     <td>
                     <button type="button" class="btn-primary" name="edit">Edit</button>
                     <button type="button" class="btn-danger" name="delete">Delete</button>
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
