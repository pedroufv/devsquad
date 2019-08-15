<?php

Route::get('/api/doc', 'Controller@apiDoc')->name('api.doc');

Route::get('{any}', 'Controller@spa')->where('any', '.*');
