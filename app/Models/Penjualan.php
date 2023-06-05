<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\DetailPenjualan;

class Penjualan extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'penjualans';
    protected $primaryKey = '_id';

    protected $fillable = [
        'invoice',
        'tanggal',
        'total_kendaraan',
        'grand_total',
    ];

    public function detailpenjualan()
    {
        return $this->embedsMany(DetailPenjualan::class);
    }
}
