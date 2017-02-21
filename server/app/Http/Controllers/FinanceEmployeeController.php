<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Repositories\AssetFlowsRepository;

class FinanceEmployeeController extends BaseController
{
    protected $repo;

    public function __construct(AssetFlowsRepository $repo) {
        $this->repo = $repo;
    }

    public function getAll(){
        return response( $this->repo->getAll() , 201);
    }

}

