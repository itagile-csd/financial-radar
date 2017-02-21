<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Repositories\AssetFlowsRepository;

class FinController extends BaseController
{
    protected $repo;

    public function __construct(AssetFlowsRepository $repo)
    {
        $this->repo = $repo;
    }

    public function add(Request $request)
    {
        $this->repo->add($request->all());

        return response(null, 201);
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

        var_dump($revenue);
        var_dump($expenses);

        $profit = $revenue - $expenses;

        var_dump($profit);

        $income_return = $profit / $revenue;

        $jsonOutput['Income_Return'] = round($income_return, 2);

        return json_encode($jsonOutput);
    }
}

