<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($dataResponse, $code = 200)
    {
        $dataResponse = array_merge($dataResponse, [
            'success' => true,
        ]);

        return response()->json($dataResponse, $code);
    }

    public function errorResponse($dataResponse, $code = 400)
    {
        $dataResponse = array_merge($dataResponse, [
            'success' => false,
        ]);

        return response()->json($dataResponse, $code);
    }


}
