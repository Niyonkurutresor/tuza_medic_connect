<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// upgrade to v3.0.0
Route::get('/upgrade-to-v3-0-0', function () {
    Artisan::call('db:seed', ['--class' => 'DefaultPaymentGatewaySeeder']);
});

Route::get('upgrade/database', function () {
    Artisan::call('migrate', ['--force' => true]);
});

Route::get('lang-js', function () {
    Artisan::call('lang:js');
});
