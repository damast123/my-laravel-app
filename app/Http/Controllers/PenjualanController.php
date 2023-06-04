<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\StockKendaraan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use App\Repositories\PenjualanRepository AS PenjualanRepo;

class PenjualanController extends Controller
{
    protected $model_penjualan;
    protected $model_detailpenjualan;
    protected $model_stock;

    public function __construct(Penjualan $penjualan, StockKendaraan $stock_kendaraan, DetailPenjualan $detail_penjualan)
    {
        // set the model
        $this->model_penjualan = new PenjualanRepo($penjualan);
        $this->model_detailpenjualan = new PenjualanRepo($detail_penjualan);
        $this->stock = new PenjualanRepo($stock_kendaraan);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model_penjualan->all();
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
            'invoice' => 'required',
            'tanggal' => 'required|date',
            'detail' => 'required|array',
            'detail.*.jumlah' => 'required|integer',
            'detail.*.harga' => 'required|numeric',
            'detail.*.kendaraans_id' => 'required'
        ]);

        $penjualanData = [
            'invoice' => $request->input('invoice'),
            'tanggal' => $request->input('tanggal')
        ];

        $detailData = $request->input('detail');

        $penjualan = $this->model_penjualan->create($penjualanData, $detailData);

        return response()->json(['message' => 'Penjualan created successfully', 'penjualan' => $penjualan], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model->show($id);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  post id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->model->delete($id);
    }
}
