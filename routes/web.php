<?php

use Illuminate\Support\Facades\Route;
use Sun\IPay\Http\Controllers\IPayController;

Route::post('', [
    'uses' => 'IPayController@index',
    'as' => IPayController::ROUTE_NAME,
]);
