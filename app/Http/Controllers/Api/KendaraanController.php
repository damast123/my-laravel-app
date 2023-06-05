<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Repositories\KendaraanRepository AS KendaraanRepo;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    protected $model_kendaraan;
    public function __construct(Kendaraan $kendaraan)
    {
        // set the model
        $this->model_kendaraan = new KendaraanRepo($kendaraan);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model_kendaraan->all();
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
        $validatedData = Validator::make($request->all(), [
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required|numeric',
            'mesin' => 'required'
        ]);

        if ($validatedData->fails()) {
            $errors = $validatedData->errors();

            // Return a response with the validation errors
            return response()->json(['errors' => $errors], 422);
        }

        // create record and pass in only fields that are fillable
        return $this->model_kendaraan->create($request->only($this->model_kendaraan->getModel()->fillable));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->model_kendaraan->getById($id);
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
       $this->model_kendaraan->update($request->only($this->model_kendaraan->getModel()->fillable), $id);
       return $this->model_kendaraan->find($id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  post id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->model_kendaraan->delete($id);
    }
}
