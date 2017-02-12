<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Log;
use DB;

class Controller extends BaseController
{

    public function addAssetFlow(Request $request)
    {
        Artisan::call('migrate');
        DB::table('asset_flows')->insert(['document' => 'testa']);
        DB::table('asset_flows')->insert(['document' => 'testa']);
        $result = DB::select('select * from asset_flows');
        Log::info(sizeof($result));
    }
}
