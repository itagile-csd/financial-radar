<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Repositories\AssetFlowsRepository;

class FinanceEmployeeController extends BaseController
{
    protected $repo;

    public function __construct(AssetFlowsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAllById($id)
    {
        $assetFlows = $this->repo->getAll();
        $assetFlowsById = [];
        foreach ($assetFlows as $data) {
            if (isset($data['EmployeeID']) && $data['EmployeeID'] === $id) {
                $assetFlowsById[] = $data;
            }
        }
        return response($assetFlowsById, 201);
    }

    public function get()
    {
        $revenue = 0;
        $expenses = 0;

        $result = $this->repo->getAll();

        foreach ($result as $asset_flow) {
            if ($asset_flow['Amount'] > 0) {
                $revenue += $asset_flow['Amount'];
            } else {
                $expenses -= $asset_flow['Amount'];
            }
        }

        $profit = $revenue - $expenses;

        $income_return = $profit / $revenue;

        $jsonOutput['Income_Return'] = round($income_return, 2);

        return json_encode($jsonOutput);
    }
}

