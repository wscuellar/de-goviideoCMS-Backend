<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait ApiResponser
{

    /**
     * Build a success response
     * @param string|array $data
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function successResponse($message, $data = null, $code = Response::HTTP_OK): JsonResponse {
        return response()->json([
            "status" => "Success",
            "message" => $message,
            "data" => $data,
        ], $code);

    }

     /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $code
     * @param null $data
     * @return JsonResponse
     **/
    public function errorResponse(string $message, $data = null, int $code = 400): JsonResponse {
        return response()->json([
            "status" => "Error",
            "message" => $message,
            "data" => $data,
        ], $code);
    }



    public function v5($name) {
        $hash = sha1($name, false);
        return sprintf(
            '%s-%s-5%s-%s',
            substr($hash,  0,  3),
            substr($hash,  3,  3),
            substr($hash,  6,  2),
            substr($hash,  9,  3)
        );
    }

      // DD log json
    public function ddJson($data)
    {
        return $this->successResponse(
            __("dd"),
                $data
            );
    }

}
