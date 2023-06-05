<?php
namespace App\Repositories\Interfaces;

interface KendaraanRepositoryInterface
{
    public function all();
    public function getAllDataWithRelationsStock();
    public function listDetailPenjualan();
    public function getById($id);
    public function getByIdStock($id);
    public function getByIdPenjualan($id);
    public function create(array $data);
    public function createPenjualan(array $penjualanData, array $detailData);
    public function update($id, array $data);
    public function delete($id);
}
?>
