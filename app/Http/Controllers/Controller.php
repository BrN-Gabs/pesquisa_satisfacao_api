<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($menssagem)
    {
        return response(
            $menssagem,
            200
        )->header('Content-Type', 'text/plain');
    }

    public function errorResponse($menssagem)
    {
        return response(
            $menssagem,
            400
        )->header('Content-Type', 'text/plain');
    }

    public function successResponseJson($menssagem)
    {
        return response(
            $menssagem,
            200
        )->header('Content-Type', 'application/json');
    }
}
