<?php

namespace App\Traits;

trait ResponseTrait
{
    public function resourceCollectionFormat($message, $data)
    {
        return [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
    }

    public function responseSuccess($message = null, $data = [])
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]); 
    } 
    
    public function responseError($message = null, $error = [], $data = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'error' => $error,
            'data' => $data
        ]);
    }

    public function responseForbidden($message = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message == null ? __('permission.unauthorized') : $message
        ], 403);
    }

    public function responseUnauthorized($message = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message == null ? __('permission.unauthorized') : $message
        ], 401);
    }

    public function responseNotFound($message = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message == null ? 'Data not found' : $message
        ], 404);
    }
}