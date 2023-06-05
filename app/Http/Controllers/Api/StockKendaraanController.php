<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StockKendaraan;
use Illuminate\Http\Request;
use App\Repositories\KendaraanRepository AS KendaraanRepo;
use Illuminate\Support\Facades\Validator;

class StockKendaraanController extends Controller
{
    protected $model;
    public function __construct(StockKendaraan $stock_kendaraan)
    {
        // set the model
        $this->model = new KendaraanRepo($stock_kendaraan);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->getAllDataWithRelationsStock();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'kendaraans_id' => 'required',
            'stock' => 'required|min:0|integer'
        ]);

        if ($validatedData->fails()) {
            $errors = $validatedData->errors();

            // Return a response with the validation errors
            return response()->json(['errors' => $errors], 422);
        }

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
        return $this->model->getByIdStock($id);
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
