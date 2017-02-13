<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Repositories\AssetFlowsRepository;

class AssetFlowsController extends BaseController
{
    protected $repo;

    public function __construct(AssetFlowsRepository $repo) {
        $this->repo = $repo;
    }

    public function set(Request $request) {
        $flows = $request->all();
        if (empty($flows)) {
            $this->repo->clear();
        }
    }

    public function add(Request $request) {
        $this->repo->add($request->all());
    }

    public function get() {
        return json_encode($this->repo->getAll());
    }
}

