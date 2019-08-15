<?php

Route::get('{any}', 'Controller@spa')->where('any', '.*');
