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

$app->get('/', function () {
    return "";
});

$app->put('/assetFlows', 'AssetFlowsController@set');
$app->post('/assetFlows', 'AssetFlowsController@add');
$app->get('/assetFlows', 'AssetFlowsController@get');

$app->get('/fin/ma/', 'FinanceEmployeeController@getAll');
