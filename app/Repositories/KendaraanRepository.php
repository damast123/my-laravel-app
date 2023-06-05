<?php
namespace App\Repositories;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Repositories\Interfaces\KendaraanRepositoryInterface;
use App\Models\DetailPenjualan;
use App\Models\StockKendaraan;
use Illuminate\Support\Facades\DB;

class KendaraanRepository implements KendaraanRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getAllDataWithRelationsStock()
    {
        $datas = $this->model->with('kendaraan')->get();

        return $datas;
    }

    public function listDetailPenjualan()
    {
        $datas = DetailPenjualan::with('penjualan','kendaraan')->get();
        return $datas;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByIdStock($id)
    {
        $datas = $this->model->with('kendaraan')->where('kendaraans_id',$id)->get();
        return $datas;
    }

    public function getByIdPenjualan($id)
    {
        $datas = DetailPenjualan::with('penjualan','kendaraan')->where('penjualans_id',$id)->get();
        return $datas;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function createPenjualan(array $penjualanData, array $detailData)
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
