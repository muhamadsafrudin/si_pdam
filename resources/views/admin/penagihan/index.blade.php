@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h3 class="">Data Penagihan</h3>

              <div class="row">
                <div class="col-sm-3">
                    <form action="" method="GET">
                      <?php
                        $bulanloop = [
                          [1,'Januari'],
                          [2,'Febuari'],
                          [3,'Maret'],
                          [4,'April'],
                          [5,'Mei'],
                          [6,'juni'],
                          [7,'Juli'],
                          [8,'Agustus'],
                          [9,'September'],
                          [10,'Oktober'],
                          [11,'November'],
                          [12,'Desember'],
                        ];
                        if(isset($_GET['bulan'])){
                          $bulan = $_GET['bulan'];
                        }else{
                          $bulan = '';
                        }
                        if(isset($_GET['tahun'])){
                          $tahun = $_GET['tahun'];
                        }else{
                          $tahun = '';
                        }
                        ?>
                        <div class="form-group">
                            <select name="bulan" class="form-control form-control-sm">
                                <option value="">-Bulan-</option>
                              @foreach ($bulanloop as $bln)
                                  <option value="{{ $bln[0] }}"{{ $bulan == $bln[0] ? 'selected' : '' }}>{{ $bln[1] }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="tahun" class="form-control form-control-sm">
                                <option value="">-Tahun-</option>
                                <?php
                                $i=1;
                                for($i; $i < 5; $i++){ ?>
                                <option value="<?=(date('Y')-$i)+1?>"<?=$tahun == (date('Y')-$i)+1 ? 'selected' : '' ?>><?=(date('Y')-$i)+1?></option>
                                 <?php
                                }
                                ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            @if (auth()->user()->role == 1 )
                            <button type="button" class="btn btn-success  btn-sm" data-toggle="modal" data-target="#modal-lg">
                                <i class="fa fa-plus"></i>  Insert Data
                            </button>
                            @endif
                            @if (auth()->user()->role < 3)
                            <a class="btn btn-sm btn-warning" href="{{ url('admin/penagihan/printlist/').'?bulan='.$bulan.'&tahun='.$tahun }}"><i class="fa fa-print"> Cetak</i></a>
                             
                            @endif
                          <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>id_pelanggan</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Tanggal</th>
                  <th>Jumlah Tunggakan</th>
                  <th>Ket</th>
                  @if (Auth()->user()->role < 3 )
                  <th>Aksi</th>
                  @endif
                 
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    @foreach ($penagihans as $penagihan)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $penagihan->id_pelanggan }}</td>
                        <td>{{ $penagihan->nama_pelanggan }}</td>
                        <td>{{ $penagihan->alamat_pelanggan }}</td>
                        <td>{{ $penagihan->tanggal_awal."/".$penagihan->tanggal_akhir }}</td>
                        <td>Rp. {{ number_format($penagihan->jumlah_tunggakan ,0,',','.') }}</td>
                        <td>{{ $penagihan->keterangan }}</td>
                        @if (Auth()->user()->role < 3 )
                        <td align="center">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-lg-{{ $penagihan->id_pelanggan }}">
                                <i class="fa fa-edit"></i>  Edit
                            </button>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin')" href="{{ url('admin/penagihan/delete').'/'.$penagihan->id_pelanggan }}"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                        @endif
                      </tr>    



                      <div class="modal fade" id="modal-lg-{{ $penagihan->id_pelanggan }}">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ url('admin/penagihan/update') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="">Id Pelanggan</label>
                                                <input readonly value="{{ $penagihan->id_pelanggan }}" required type="text" class="form-control" name="id_pelanggan" placeholder="id pelanggan...">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Pelanggan</label>
                                                <input value="{{ $penagihan->nama_pelanggan }}" required type="text" class="form-control" name="nama_pelanggan" placeholder="nama pelanggan...">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alamat Pelanggan</label>
                                                <textarea required class="form-control" name="alamat_pelanggan" placeholder="alamat pelanggan.." cols="30" rows="5">{{ $penagihan->alamat_pelanggan }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group col-sm">
                                                <label for="">Awal Tanggal </label>
                                                <input value="{{ $penagihan->tanggal_awal }}" required type="date" class="form-control" name="tgl_aw">
                                            </div>
                                            <div class="form-group col-sm">
                                                <label for="">Akhir Tanggal</label>
                                                <input value="{{ $penagihan->tanggal_akhir }}" required type="date" class="form-control" name="tgl_ak">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jumlah tunggakan</label>
                                                <input value="{{ $penagihan->jumlah_tunggakan }}" required type="number" class="form-control" name="tunggakan" placeholder="jumlah tunggakan..">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Keterangan</label>
                                                <input value="{{ $penagihan->keterangan }}" type="text" name="ket" class="form-control" placeholder="keterangan..">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="reset" class="btn btn-info btn-sm float-right" ><i class="fa fa-refresh"></i> Reset</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                    </div>
                                </div>
                            </form>    
                        </div>
                      </div>




                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    




  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form action="{{ url('admin/penagihan/store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="">Id Pelanggan</label>
                            <input value="{{ old('id_pelanggan') }}" required type="text" class="form-control @error('id_pelanggan') is-invalid @enderror " name="id_pelanggan" placeholder="id pelanggan...">
                            @error('id_pelanggan') <small class="text-danger">Id pelanggan sudah digunakan ganti yang lain</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Pelanggan</label>
                            <input value="{{ old('nama_pelanggan') }}" required type="text" class="form-control" name="nama_pelanggan" placeholder="nama pelanggan...">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Pelanggan</label>
                            <textarea required class="form-control" name="alamat_pelanggan" placeholder="alamat pelanggan.." cols="30" rows="5">{{  old('alamat_pelanggan') }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group col-sm">
                            <label for="">Awal Tanggal </label>
                            <input value="{{ old('tgl_aw') }}" required type="date" class="form-control" name="tgl_aw">
                        </div>
                        <div class="form-group col-sm">
                            <label for="">Akhir Tanggal</label>
                            <input value="{{ old('tgl_ak') }}" required type="date" class="form-control" name="tgl_ak">
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah tunggakan</label>
                            <input value="{{ old('tunggakan') }}" required type="number" class="form-control" name="tunggakan" placeholder="jumlah tunggakan..">
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input value="{{ old('ket') }}" type="text" name="ket" class="form-control" placeholder="keterangan..">
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                <button type="reset" class="btn btn-info btn-sm float-right" ><i class="fa fa-refresh"></i> Reset</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>
        </form>    
    </div>
  </div>




@endsection