<?php

/**
 * --------------------------------------------------------------------------
 * Root url
 * --------------------------------------------------------------------------
 */
Route::get('/', function() {
    return Redirect::route('payment.subscribe');
});

/**
 * --------------------------------------------------------------------------
 * /payment | Payment and subscription related sites
 * --------------------------------------------------------------------------
 */
include 'routes/payment.php';
