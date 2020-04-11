<?php

namespace App\Traits;

trait ApiResponse
{
    public function succesResponse($message = 'Success', $code = 200)
    {
        return [
            'message'   => $message,
            'code'      => $code
        ];
    }

    public function errorResponse($data = [], $message = 'Error', $code = 500)
    {
        return response([
            'data'      => $data,
            'message'   => $message,
            'code'      => $code
        ], $code);
    }

}
