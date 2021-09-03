<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Produk\ProdukRequest;
use App\Services\ProdukService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    private $service;

    public function __construct(ProdukService $service)
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
        return view('produk');
    }

    public function datatable()
    {
        return DataTables::of($this->service->datatable())
            ->addIndexColumn()
            ->editColumn('foto', function ($data) {
                $btnTambahFoto = '<button class="btn btn-sm btn-success btn-foto-produk" data-id="' . $data->id . '"><i class="fas fa-plus"></i> Foto</button>';
                if (!$data->foto) {
                    return $btnTambahFoto;
                }

                $html = '<img src="">';
                $html .= $btnTambahFoto;

                return $html;
            })
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-sm btn-warning btn-edit-produk" data-id="'.$data->id.'" data-item="'.htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8').'"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger btn-hapus-produk" data-id="'.$data->id.'"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['foto', 'opsi'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProdukRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProdukRequest $request)
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * @return \Illuminate\Http\Response
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
