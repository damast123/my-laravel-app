<?php
namespace App\Repositories;

use Jenssegers\Mongodb\Eloquent\Model;
use App\Repositories\Interfaces\StockKendaraanRepositoryInterface;
class StockKendaraanRepository implements StockKendaraanRepositoryInterface
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

    public function getAllDataWithRelations()
    {
        $datas = $this->model->with('kendaraan')->get();

        return $datas;
    }

    public function getById($id)
    {
        $datas = $this->model->with('kendaraan')->where('kendaraans_id',$id)->get();
        return $datas;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
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
