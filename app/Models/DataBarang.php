<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataBarang extends Authenticatable
{
    use HasFactory;


    protected $table = 'data_barang';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'jenis_barang',
        'stock_barang',
        'harga_beli',
        'harga_jual',
        'gambar_barang',

    ];
}
