<?php
namespace App\Repositories;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Repositories\Interfaces\PenjualanRepositoryInterface;
use App\Models\DetailPenjualan;
use App\Models\StockKendaraan;
use DB;

class PenjualanRepository implements PenjualanRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $datas = DetailPenjualan::with('penjualan','kendaraan')->get();
        return $datas;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $penjualanData, array $detailData)
    {
        $penjualan = $this->model->create($penjualanData);

        $total = 0;
        $grandTotal = 0;

        foreach ($detailData as $detail) {
            $kendaraansId = $detail['kendaraans_id'];
            $jumlah = $detail['jumlah'];
            $detail['penjualans_id'] = $penjualan->id;
            DetailPenjualan::create($detail);

            // Decrease stock
            $stockKendaraan = StockKendaraan::where('kendaraans_id', $kendaraansId)->firstOrFail();
            $currentStock = $stockKendaraan->stock;
            $newStock = $currentStock - $jumlah;

            // Update stock
            $stockKendaraan->stock = $newStock;
            $stockKendaraan->save();

            $total += $detail['jumlah'];
            $grandTotal += $detail['jumlah'] * $detail['harga'];
        }

        $penjualan->update([
            'total_kendaraan' => $total,
            'grand_total' => $grandTotal
        ]);

        return $penjualan;
    }

    public function update($id, array $data)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}
?>
