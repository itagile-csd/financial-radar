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

    public function getAllById( $id ){
        $assetFlows = $this->repo->getAll();
        $assetFlowsById = [];
        foreach($assetFlows as $data) {
            if(isset($data['Employee']) && $data['Employee'] === $id) {
                $assetFlowsById[] = $data;
            }
        }
        return response( $assetFlowsById , 200);
    }

}

