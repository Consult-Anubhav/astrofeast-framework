<?php

namespace App\Http\Controllers\v1_0_0;

use App\Http\Controllers\Controller;
use App\Models\TestModel;

class TestCustomerController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function getProduct()
    {
        return response()->json([
            "data" => TestModel::getRandomProduct(),
            "status" => 200
        ]);
    }
}
