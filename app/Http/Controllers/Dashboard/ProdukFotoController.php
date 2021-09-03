<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Produk\ProdukFotoRequest;
use App\Services\ProdukFotoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProdukFotoController extends Controller
{
    private $service;

    public function __construct(ProdukFotoService $service)
    {
        $this->service = $service;
    }

    public function datatable(Request $request)
    {
        return DataTables::of($this->service->datatable($request->produk_id))
            ->addIndexColumn()
            ->addColumn('foto', function($data) {
                return asset('storage/'. $data->file);
            })
            ->addColumn('opsi', function ($data) {
                return '<button class="btn btn-sm btn-outline-danger btn-hapus-foto" data-id="' . $data->id . '"><i class="fas fa-trash"></i></button>';
            })
            ->rawColumns(['foto', 'opsi'])
            ->make(true);
    }

    public function store(ProdukFotoRequest $request)
    {
        try {
            $foto = $request->file('foto');
            $fotoUploaded = $foto->store('produk', 'public');

            $data = [
                'produk_id' => $request->produk_id,
                'file' => $fotoUploaded,
                'deskripsi' => $request->deskripsi
            ];

            $response = $this->service->create($data);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => TRUE,
            'data' => $response
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        try {
            $foto = $this->service->find($id);

            File::delete('storage/' . $foto->file);

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
