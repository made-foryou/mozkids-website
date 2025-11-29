<?php

use Made\Cms\Facades\Cms;

\Illuminate\Support\Facades\Route::get('/test', function () {
    return session()->id();
});

Cms::routes();
