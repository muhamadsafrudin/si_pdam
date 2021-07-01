@extends('template/template')
@section('content')
<?php
        if(isset($_GET['bulan'])){
            $bulan = $_GET['bulan'];
            if($bulan == 1){
              $bulan = "Januari";
            }elseif($bulan == 2){
              $bulan = "Febuari";
            }elseif($bulan == 3){
              $bulan = "Maret";
            }elseif($bulan == 4){
              $bulan = "April";
            }elseif($bulan == 5){
              $bulan = "Mei";
            }elseif($bulan == 6){
              $bulan = "Juni";
            }elseif($bulan == 7){
              $bulan = "Juli";
            }elseif($bulan == 8){
              $bulan = "Agustus";
            }elseif($bulan == 9){
              $bulan = "September";
            }elseif($bulan == 10){
              $bulan = "Oktober";
            }elseif($bulan == 11){
              $bulan = "November";
            }elseif($bulan == 12){
              $bulan = "Desember";
            }
        }else{
            $bulan = "-";
        }
        if(isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        }else{
            $tahun = "-";
        }
  
?>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12"> 
          <div class="card">
            <div class="card-header">
              <h3 class="">{{ $judul }}</h3>
              <h6>Bulan : {{ $bulan }} </h6>
              <h6>Tahun : {{ $tahun }}</h6>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover">
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total Rp. {{ number_format($total,0,',','.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>    
  <script>
    window.print();
  </script>
@endsection