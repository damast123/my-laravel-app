<?php

namespace App\Http\Controllers;

use App\Models\StockKendaraan;
use Illuminate\Http\Request;
use App\Repositories\StockKendaraanRepository AS StockKendaraanRepo;

class StockKendaraanController extends Controller
{
    protected $model;
    public function __construct(StockKendaraan $stock_kendaraan)
    {
        // set the model
        $this->model = new StockKendaraanRepo($stock_kendaraan);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->getAllDataWithRelations();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kendaraans_id' => 'required',
            'stock' => 'required|min:1'
        ]);

        // create record and pass in only fields that are fillable
        return $this->model->create($request->only($this->model->getModel()->fillable));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model->getById($id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  post id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update model and only pass in the fillable fields
       $this->model->update($request->only($this->model->getModel()->fillable), $id);
       return $this->model->find($id);
    }
}
