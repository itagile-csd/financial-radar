<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Repositories\AssetFlowsRepository;

class AssetFlowsController extends BaseController
{
    protected $repo;

    public function __construct(AssetFlowsRepository $repo) {
        $this->repo = $repo;
    }

    public function add() {}

    public function get() {
        return json_encode($this->repo->getAll());
    }
}

