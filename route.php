<?php

use App\Route;

Route::post('/withdraw', 'Web\OperationsController@withdraw');

Route::post('/deposit', 'Web\OperationsController@deposit');

Route::get('/statement', 'Web\OperationsController@statement');
