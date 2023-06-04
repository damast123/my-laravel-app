<?php
namespace App\Repositories\Interfaces;

interface StockKendaraanRepositoryInterface
{
    public function getAllDataWithRelations();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
?>
