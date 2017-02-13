<?php

namespace App\Repositories;

use Log;

class AssetFlowsRepository {
    public function __construct() {
        Log::info('constructed');
    }

    public function getAll() {
        return array(array("amount" => 1));
    }
}

