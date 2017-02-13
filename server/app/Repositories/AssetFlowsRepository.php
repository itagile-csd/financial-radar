<?php

namespace App\Repositories;

use Log;
use Illuminate\Support\Facades\Storage;

class AssetFlowsRepository {
    protected $flows;

    public function __construct() {
        Log::info('constructed');
        $flows = array(array("amount" => 1));
        Storage::put('assetFlows.json', json_encode($flows));
        $this->flows = json_decode(Storage::get('assetFlows.json'));
    }

    public function getAll() {
        return $this->flows;
    }
}

