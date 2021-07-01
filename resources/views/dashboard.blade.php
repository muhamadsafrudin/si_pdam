@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h2 class="">Selamat Datang</h2>
              <h5>{{ auth()->user()->name }}({{ auth()->user()->role == 1 ? "Administrator" : "Petugas" }})</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{ $tl_penagihan }}</h3>
        
                        <p>Data Penagihan</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-money-check-alt"></i>
                      </div>
                      <a href="{{ url('admin/penagihan') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  @if (auth()->user()->role == 1)
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{ $tl_user }}</h3>
        
                        <p>Users</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-users"></i>
                      </div>
                      <a href="{{ url('admin/user') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div> 
                  @endif
       
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    
@endsection