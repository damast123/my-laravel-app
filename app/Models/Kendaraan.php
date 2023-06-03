<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\StockKendaraan;
use App\Models\DetailPenjualan;

class Kendaraan extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'kendaraans';
    protected $primaryKey = '_id';

    protected $fillable = [
        'tahun_keluaran',
        'warna',
        'harga',
    ];

    public function stockkendaraan()
    {
        return $this->hasMany(StockKendaraan::class);
    }

    public function detailpenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
