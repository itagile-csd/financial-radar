<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Repositories\AssetFlowsRepository;

class FinanceEmployeeController extends BaseController
{

    public function getAll(){
        return response(null, 201);
    }

}

