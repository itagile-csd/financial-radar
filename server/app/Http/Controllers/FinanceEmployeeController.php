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

    public function getAllByEmployee($employee )
    {
        return response( $this->repo->getAllByEmployee($employee) , 200);
    }

    public function calculateRevenueByEmployee($employee )
    {
        $assetFlowsForEmployee = $this->repo->getAllByEmployee($employee);
        $income = 0;
        foreach($assetFlowsForEmployee as $currentAssetFlow) {
            $income += $currentAssetFlow['Amount'];
        }

        $jsonOutput['Income'] = json_encode($income);
        return response($jsonOutput, 200);
    }

}

