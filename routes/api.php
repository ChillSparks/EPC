<?php

use App\Store;

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::get('store/{id}', function($id) {
        return Store::find($id);
    });
});
