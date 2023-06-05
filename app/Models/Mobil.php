<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;

class Mobil extends Kendaraan
{
    protected $collection = 'kendaraans';

    protected $fillable = [
        'mesin',
        'kapisitas_penumpang',
        'tipe',
    ];
}
