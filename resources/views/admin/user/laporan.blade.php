@extends('template/template')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h3 class="">Laporan Penagihan</h3>
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
                            ?>
                            <div class="form-group">
                                <select name="bulan" class="form-control form-control-sm">
                                    <option value="">-Bulan-</option>
                                  @foreach ($bulanloop as $bln)
                                      <option value="{{ $bln[0] }}"{{ $bulan == $bln[0] ? 'selected' : '' }}>{{ $bln[1] }}</option>
                                  @endforeach





                                    {{-- <option value="01">Januari</option>
                                    <option value="02">Febuary</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option> --}}

                                </select>
                            </div>
                            <div class="form-group">
                                <select name="tahun" class="form-control form-control-sm">
                                    <option value="">-Tahun-</option>
                                    <?php
                                    $i=1;
                                    for($i; $i < 5; $i++){ ?>
                                    <option value="<?=(date('Y')-$i)+1?>"><?=(date('Y')-$i)+1?></option>
                                     <?php
                                    }
                                    ?>
                                </select>
                            </div> 
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                  <th>id_pelanggan</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Tanggal</th>
                  <th>Jumlah Tunggakan</th>
                  <th>Keterangan</th>
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