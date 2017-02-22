<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;

class AssetFlowsRepository {
    protected $flows;

    public function __construct() {
        if (Storage::exists('assetFlows.json')) {
            $this->flows = json_decode(Storage::get('assetFlows.json'), true);
            return;
        }
        $this->flows = array();
        Storage::put('assetFlows.json', '');

    }

    public function add($flow) {
        $this->flows[] = $flow;
        Storage::put('assetFlows.json', json_encode($this->flows));
    }

    public function getAll() {
        return $this->flows;
    }

    public function getAllByEmployee(String $employee)
    {
        $assetFlowsByEmployee = [];
        foreach($this->flows as $data) {
            if(isset($data['Employee']) && $data['Employee'] === $employee) {
                $assetFlowsByEmployee[] = $data;
            }
        }
        return $assetFlowsByEmployee;
    }

    public function clear() {
        $this->flows = array();
        Storage::put('assetFlows.json', json_encode($this->flows));
    }


}

