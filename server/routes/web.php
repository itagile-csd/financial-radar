<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

$app->get('/', function () {
    return "";
});

$app->post('/assetFlows', function (Request $request) {
});

$app->get('/assetFlows', function () {
    $result = array(array("amount" => 1));
    return json_encode($result);
});
