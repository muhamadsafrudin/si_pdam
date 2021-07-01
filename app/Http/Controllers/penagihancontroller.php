<?php

namespace App\Http\Controllers;

use App\Models\penagihan;
use Illuminate\Http\Request;

class penagihancontroller extends Controller
{

    public function index(Request $request)
    {
        if($request->bulan && $request->tahun){
            $penagihans = penagihan::whereMonth('tanggal_awal', $request->bulan)
                                        ->whereYear('tanggal_awal', $request->tahun)->get();
        }elseif($request->bulan){
            $penagihans = penagihan::whereMonth('tanggal_awal', $request->bulan)->get();
        }elseif($request->tahun){

            $penagihans = penagihan::whereYear('tanggal_awal', $request->tahun)->get();
        }else{
            $penagihans = penagihan::all();
        }
        return view('admin/penagihan/index', compact('penagihans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan'      => 'unique:tb_penagihan,id_pelanggan',
        ]);
        $data = [
            'id_pelanggan'      => $request->id_pelanggan,
            'nama_pelanggan'    => $request->nama_pelanggan,
            'alamat_pelanggan'  => $request->alamat_pelanggan,
            'tanggal_awal'      => $request->tgl_aw,
            'tanggal_akhir'     => $request->tgl_ak,
            'jumlah_tunggakan'  => $request->tunggakan,
            'keterangan'        => $request->ket
    
        ];
        //dd($data);
        penagihan::insert($data);
        return redirect('admin/penagihan')->with('success','Data berhasil ditambah');
    }


    public function update(Request $request)
    {
        $data = [
            'id_pelanggan'      => $request->id_pelanggan,
            'nama_pelanggan'    => $request->nama_pelanggan,
            'alamat_pelanggan'  => $request->alamat_pelanggan,
            'tanggal_awal'      => $request->tgl_aw,
            'tanggal_akhir'     => $request->tgl_ak,
            'jumlah_tunggakan'  => $request->tunggakan,
            'keterangan'        => $request->ket
    
        ];
        penagihan::where('id_pelanggan', $request->id_pelanggan)->update($data);
        return redirect('admin/penagihan')->with('success','Data berhasil diedit');
    }

    public function destroy($id)
    {
        penagihan::where('id_pelanggan', $id)->delete();
        return redirect('admin/penagihan')->with('success','Data berhasil dihapus');
    }



    public function laporan(Request $request)
    {
        if($request->bulan && $request->tahun){
            $penagihans = penagihan::whereMonth('tanggal_awal', $request->bulan)
                                        ->whereYear('tanggal_awal', $request->tahun)->get();
        }elseif($request->bulan){
            $penagihans = penagihan::whereMonth('tanggal_awal', $request->bulan)->get();
        }elseif($request->tahun){

            $penagihans = penagihan::whereYear('tanggal_awal', $request->tahun)->get();
        }else{
            $penagihans = penagihan::whereMonth('tanggal_awal', 20)->get();
        }
        return view('admin/penagihan/laporan', compact('penagihans'));
    }

    public function print()
    {
        $judul = "Cetak Laporan Penagihan";
        if(isset($_GET['bulan'])){
            $bulan = $_GET['bulan'];
        }else{
            $bulan = null;
        }
        if(isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        }else{
            $tahun = null;
        }
       // dd($bulan.$tahun);

        if($bulan != null && $tahun != null){
            $penagihans = penagihan::whereMonth('tanggal_awal', $bulan)
                                        ->whereYear('tanggal_awal', $tahun)->get();
            $total = penagihan::whereMonth('tanggal_awal', $bulan)
                                        ->whereYear('tanggal_awal', $tahun)->get()->sum('jumlah_tunggakan');
        }elseif($bulan != null){
            $penagihans = penagihan::whereMonth('tanggal_awal', $bulan)->get();
            $total = penagihan::whereMonth('tanggal_awal', $bulan)->get()->sum('jumlah_tunggakan');
        }elseif($tahun != null){
            $penagihans = penagihan::whereYear('tanggal_awal', $tahun)->get();
            $total = penagihan::whereYear('tanggal_awal', $tahun)->get()->sum('jumlah_tunggakan');
        }else{
            $penagihans = penagihan::whereMonth('tanggal_awal', 20)->get();
            $total = penagihan::whereMonth('tanggal_awal', 20)->get()->sum('jumlah_tunggakan');
        }
        return view('admin/penagihan/print', compact('penagihans','total','judul'));
    }

    public function printlist()
    {
        $judul = "Cetak Data Penagihan";

        if(isset($_GET['bulan'])){
            $bulan = $_GET['bulan'];
        }else{
            $bulan = null;
        }
        if(isset($_GET['tahun'])){
            $tahun = $_GET['tahun'];
        }else{
            $tahun = null;
        }
       // dd($bulan.$tahun);

        if($bulan != null && $tahun != null){
            $penagihans = penagihan::whereMonth('tanggal_awal', $bulan)
                                        ->whereYear('tanggal_awal', $tahun)->get();
            $total = penagihan::whereMonth('tanggal_awal', $bulan)
                                        ->whereYear('tanggal_awal', $tahun)->get()->sum('jumlah_tunggakan');
        }elseif($bulan != null){
            $penagihans = penagihan::whereMonth('tanggal_awal', $bulan)->get();
            $total = penagihan::whereMonth('tanggal_awal', $bulan)->get()->sum('jumlah_tunggakan');
        }elseif($tahun != null){
            $penagihans = penagihan::whereYear('tanggal_awal', $tahun)->get();
            $total = penagihan::whereYear('tanggal_awal', $tahun)->get()->sum('jumlah_tunggakan');
        }else{
            $penagihans = penagihan::all();
            $total = penagihan::all()->sum('jumlah_tunggakan');
        }
        return view('admin/penagihan/print', compact('penagihans','total','judul'));
    }
}
