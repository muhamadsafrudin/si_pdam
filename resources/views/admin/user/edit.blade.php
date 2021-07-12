@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h3 class="">Tambah user</h3>
              <a class="btn btn-sm btn-primary float-right" href="{{ url('admin/user/') }}"><i class="fa fa-undo"></i> Kembal</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row justify-content-center">
                <div class="col-sm-7">
                  <form action="{{ url('admin/user/update').'/'.$user->id }}" method="POST" class="row">
                    @csrf
                      <div class="form-group col-sm-8">
                        <label for="">Nama user *</label>
                        <input class="form-control @error('nama') is-invalid  @enderror" type="text" value="{{ old('nama') == '' ? $user->name : old('nama') }}" name="nama" placeholder="nama user..">
                        <small class="text-danger">@error('nama') {{ $message }}  @enderror</small>
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="">Role/Akses *</label>
                        <select name="role" class="form-control @error('role') is-invalid  @enderror">
                          <option value="1"<?=$user->role  == 1 ? 'selected' : '' ?>>Administrator</option>
                          <option value="2" <?=$user->role  == 2 ? 'selected' : '' ?>>Petugas</option>
                          <option value="3" <?=$user->role  == 3 ? 'selected' : '' ?>>Ketua Bagian</option>
                        </select>
                        <small class="text-danger">@error('role') {{ $message }}  @enderror</small>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="">Password *</label>
                        <input class="form-control @error('password') is-invalid  @enderror" type="password" value="" name="password" placeholder="Password user..">
                        <small class="text-danger">@error('password') {{ $message }}  @enderror</small>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="">Konfirmasi Password</label>
                        <input class="form-control @error('passconf') is-invalid  @enderror" type="password" value="" name="passconf" placeholder="Konfirmasi Password..">
                        <small class="text-danger">@error('passconf') {{ $message }}  @enderror</small>
                      </div>
                      <div class="col-sm form-group">
                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    

@endsection