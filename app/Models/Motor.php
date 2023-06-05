<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;

class Motor extends Kendaraan
{
    use HasFactory;

    protected $collection = 'kendaraans';

    protected $fillable = [
        'mesin',
        'tipe_suspensi',
        'tipe_transmisi',
    ];
}
