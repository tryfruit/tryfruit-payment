<?php

/**
 * Routes for payment pages
 * @see PaymentController
 */
Route::group([
        'prefix'    => '',
    ], function() {

    Route::get('subscribe', [
        'as'        => 'payment.subscribe',
        'uses'      => 'PaymentController@getSubscribe'
    ]);

    Route::post('subscribe', [
        'as'        => 'payment.subscribe',
        'uses'      => 'PaymentController@postSubscribe'
    ]);

    Route::get('success', [
        'as'        => 'payment.success',
        'uses'      => 'PaymentController@getSuccess'
    ]);
});

