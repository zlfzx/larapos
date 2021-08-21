<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kategori\KategoriRequest;
use App\Services\KategoriService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    use ApiResponse;

    /**
     * @var KategoriService
     */
    private $service;

    public function __construct(KategoriService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $data = $this->service->getAll();

        return $this->ok($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KategoriRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(KategoriRequest $request)
    {
        $response = $this->service->create($request->all());

        return $this->created($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $response = $this->service->find($id);

        if (!$response) {
            return $this->notFound();
        }

        return $this->ok($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KategoriRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(KategoriRequest $request, int $id)
    {
        $response = $this->service->update($request->all(), $id);

        return $this->ok($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $response = $this->service->delete($id);

        return $this->ok($response);
    }
}
