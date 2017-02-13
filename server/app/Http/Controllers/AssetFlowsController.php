<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class AssetFlowsController extends BaseController
{
    public function add() {}

    public function get() {
        $result = array(array("amount" => 1));
        return json_encode($result);
    }
}

