<?php
namespace App\Repositories\Interfaces;

interface PenjualanRepositoryInterface
{
    public function all();
    public function getById($id);
    public function create(array $penjualanData, array $detailData);
    public function update($id, array $data);
    public function delete($id);
}
?>
