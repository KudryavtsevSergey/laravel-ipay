<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Sun\IPay\Http\Controllers\IPayController;

Route::post('callback', IPayController::class);
