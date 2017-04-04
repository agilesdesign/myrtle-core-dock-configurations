<?php

Route::get('configurations/app', [
    'uses' => \Myrtle\Core\Configurations\Http\Controllers\Administrator\ConfigurationAppController::class . '@edit',
    'as' => 'configurations.app.edit',
]);

Route::patch('configurations/app', [
    'uses' => \Myrtle\Core\Configurations\Http\Controllers\Administrator\ConfigurationAppController::class . '@update',
    'as' => 'configurations.app.update',
]);

Route::get('configurations/session', [
    'uses' => \Myrtle\Core\Configurations\Http\Controllers\Administrator\ConfigurationSessionController::class . '@edit',
    'as' => 'configurations.session.edit',
]);

Route::patch('configurations/session', [
    'uses' => \Myrtle\Core\Configurations\Http\Controllers\Administrator\ConfigurationSessionController::class . '@update',
    'as' => 'configurations.session.update',
]);