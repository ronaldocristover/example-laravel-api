<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function wrapper($status = 'NOT OK', $result = [], $responseCode = 200, $errors = null)
    {
        if(is_null($errors)) $errors = new \stdClass();
        return response([
            'status' => $status,
            'result' => $result,
            'errors' => $errors
        ], $responseCode);
    }
}
