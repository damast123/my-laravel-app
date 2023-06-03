<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Kendaraan;
use App\Models\Penjualan;

class DetailPenjualan extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'detail_penjualans';

    protected $fillable = [
        'kendaraans_id',
        'penjualans_id',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
