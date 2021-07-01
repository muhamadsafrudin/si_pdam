<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penagihan extends Model
{
    use HasFactory;
    protected $table = "tb_penagihan";
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'alamat_pelanggan',
        'tanggal_awal',
        'tanggal_akhir',
        'jumlah_tunggakan',
        'keterangan'

    ];
}
