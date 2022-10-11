<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\users\UserCreate;

Route::controller(UserCreate::class)->group(function(){

    Route::get('/create', 'register')->name('create');

    Route::post('/create', 'traiteRegister')->name('traiteregister');

    Route::get('/create/{login}/{id}', 'registerFilleul')->whereAlpha('login')
    ->whereNumber('id')
    ->name('registerFilleul');

    

});