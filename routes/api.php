<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
JOSE LUIS BUENAÑO TOAPANTA
luisbuenao51@hotmail.com
0992823863
*/


Route::apiResource('/perfils','PerfilController');



/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
