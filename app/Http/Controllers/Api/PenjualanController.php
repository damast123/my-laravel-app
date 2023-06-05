<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Repositories\KendaraanRepository AS KendaraanRepo;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    protected $model_penjualan;

    public function __construct(Penjualan $penjualan)
    {
        // set the model
        $this->model_penjualan = new KendaraanRepo($penjualan);
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

    public function detail()
    {
        return $this->model_penjualan->listDetailPenjualan();
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
            'invoice' => 'required',
            'tanggal' => 'required|date',
            'detail' => 'required|array',
            'detail.*.jumlah' => 'required|integer',
            'detail.*.harga' => 'required|numeric',
            'detail.*.kendaraans_id' => 'required'
        ]);

        if ($validatedData->fails()) {
            $errors = $validatedData->errors();

            // Return a response with the validation errors
            return response()->json(['errors' => $errors], 422);
        }

        $penjualanData = [
            'invoice' => $request->input('invoice'),
            'tanggal' => $request->input('tanggal')
        ];

        $detailData = $request->input('detail');

        $penjualan = $this->model_penjualan->createPenjualan($penjualanData, $detailData);

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
        return $this->model_penjualan->getByIdPenjualan($id);
    }
}
