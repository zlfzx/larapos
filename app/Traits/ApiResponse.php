<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    public function prepareResponse(string $message = '', int $statusCode = Response::HTTP_OK): array
    {
        if (empty($message)) {
            $message = Response::$statusTexts[$statusCode];
        }

        return [
            'message' => $message,
            'status_code' => $statusCode
        ];
    }

    public function success($data, int $statusCode = Response::HTTP_OK, string $message = '')
    {
        $response = $this->prepareResponse($message, $statusCode);
        $response['data'] = $data;

        return $this->json($response);
    }

    public function ok($data, string $message = '')
    {
        return $this->success($data, Response::HTTP_OK, $message);
    }

    public function created($data, string $message = '')
    {
        return $this->success($data, Response::HTTP_CREATED, $message);
    }

    public function error($errors, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, string $message = '')
    {
        $response = $this->prepareResponse($message, $statusCode);
        $response['errors'] = $errors;

        return $this->json($response);
    }

    public function badRequest($data, string $message = '')
    {
        return $this->error($data, Response::HTTP_BAD_REQUEST, $message);
    }

    public function unauthorized($data, string $message = '')
    {
        return $this->error($data, Response::HTTP_UNAUTHORIZED, $message);
    }

    public function forbidden($data, string $message = '')
    {
        return $this->error($data, Response::HTTP_FORBIDDEN, $message);
    }

    public function notFound($data, string $message = '')
    {
        return $this->error($data, Response::HTTP_NOT_FOUND, $message);
    }

    public function unprocessable($data, string $message = '')
    {
        return $this->error($data, Response::HTTP_UNPROCESSABLE_ENTITY, $message);
    }

    private function json($response)
    {
        return response()->json($response);
    }

}
