<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suplier\SuplierRequest;
use App\Services\SuplierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class SuplierController extends Controller
{
    /**
     * @var SuplierService
     */
    private $service;

    public function __construct(SuplierService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suplier');
    }

    public function datatable()
    {
        return DataTables::of($this->service->datatable())
            ->addIndexColumn()
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-sm btn-warning btn-edit" data-id="'.$data->id.'" data-item="'.htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8').'"><i class="fas fa-edit"></i></button> 
                <button class="btn btn-sm btn-danger btn-hapus" data-id="'.$data->id.'"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SuplierRequest $request)
    {
        try {
            $response = $this->service->create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => FALSE,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SuplierRequest $request, $id)
    {
        try {
            $response = $this->service->update($request->all(), $id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => FALSE,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $response = $this->service->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => FALSE,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }
}
