<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suplier\SuplierRequest;
use App\Services\SuplierService;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;

class SuplierController extends Controller
{
    use ApiResponse;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = $this->service->getAll();

        return $this->ok($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SuplierRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SuplierRequest $request)
    {
        try {
            $response = $this->service->create($request->all());
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->ok($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $response = $this->service->find($id);

        return $this->ok($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SuplierRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SuplierRequest $request, $id)
    {
        try {
            $response = $this->service->update($request->all(), $id);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->ok($response);
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
            return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $this->ok($response);
    }
}
