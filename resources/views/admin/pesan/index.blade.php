<?php
use App\Models\pesan;
$dbps = new pesan();
$i =1;
?>
@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h3 class="">Pesan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama User</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($user as $data)
                  @php
                      if($data->role == 1){
                        $role = 'Admin';
                      }else if($data->role == 2){
                        $role = 'Petugas';
                      }else{
                        $role = 'Ketua Bagian';
                      }

                      $jmlh_p = $dbps->where(['to' => auth()->user()->id, 'from' => $data->id, 'status' => 1 ])->count();
                      if($jmlh_p > 0){
                          $jmlh_p = "(".$jmlh_p.")";
                      }else{
                        $jmlh_p = "";
                      }
                  @endphp
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $jmlh_p." ".$data->name }}</td>
                      <td>{{ $role }}</td>
                      <td align="center" width="200px">
                        <a class="btn btn-sm btn-primary" href="{{ url('pesan',$data->id) }}"><i class="fa fa-paper-plane"></i> Pesan</a>
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