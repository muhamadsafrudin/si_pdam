@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h3 class="">Data user</h3>
              <a class="btn btn-sm btn-success" href="{{ url('admin/user/create') }}"><i class="fa fa-plus"></i> Tambah user</a>
            </div>
            @if ($message = Session::get('success'))
                <div id="alert" data-alert="{{ $message }}"></div>
            @endif
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role/Akses</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    @foreach ($users as $user)
                    @php
                    if($user->role == 1){
                        $role = "Admin";
                    }else if($user->role == 2){
                        $role = "Petugas";
                    }else if($user->role == 3){
                        $role = "Ketua Bagian";
                    } 
                    @endphp
             
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $role }}</td>
                        <td align="center">
                            <a class="btn btn-sm btn-primary" href="{{ url('admin/user/edit').'/'.$user->id }}"><i class="fa fa-edit"></i> Edit</a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin')" href="{{ url('admin/user/delete').'/'.$user->id }}"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                      </tr>    
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    

@endsection