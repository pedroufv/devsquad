<?php

Route::get('/landing', 'Controller@landing');
Route::get('/public/files/{filename}', 'Controller@file');
Route::get('{any}', 'Controller@spa')->where('any', '.*');
