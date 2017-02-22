<?php

namespace App\Http\Controllers;

use App\RevenueCalculator;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Repositories\AssetFlowsRepository;

class FinanceEmployeeController extends BaseController
{
    protected $repo;

    public function __construct(AssetFlowsRepository $repo) {
        $this->repo = $repo;
    }

    public function getAllByEmployee($employee, Request $request )
    {
        $assetFlows = $this->repo->getAllByEmployee($employee);
        $year = $request->get("year");
        if(isset($year)){
            $month  = $request->get("month");
            $assetFlows = RevenueCalculator::filterRevenueByYear($assetFlows, $year, $month);
        }
        return response($assetFlows  , 200);
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

    public function get()
    {
        $result = $this->repo->getAll();

        if (count($result) <= 0)
        {
            $jsonOutput['IncomeReturn'] = 0;

            return json_encode($jsonOutput);
        }

        $revenue = 0;
        $expenses = 0;

        foreach ($result as $asset_flow) {
            if ($asset_flow['Amount'] > 0) {
                $revenue += $asset_flow['Amount'];
            } else {
                $expenses -= $asset_flow['Amount'];
            }
        }

        $profit = $revenue - $expenses;

        if ($revenue !== 0)
        {
            $income_return = $profit / $revenue;
        }
        else
        {
            $income_return = 0;
        }

        $jsonOutput['IncomeReturn'] = $income_return;

        return json_encode($jsonOutput);
    }
}

