<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Kendaraan;

class StockKendaraan extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $collection = 'stock_kendaraans';
    protected $primaryKey = '_id';

    protected $fillable = [
        'kendaraans_id',
        'stock',
    ];
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraans_id');
    }
}
