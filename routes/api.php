<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
JOSE LUIS BUENAÑO TOAPANTA
luisbuenao51@hotmail.com
0992823863
*/

Route::post('/login-user','UserController@login');
Route::post('/leerMensajes/{chatPerfil}','ChatPerfilController@leer');
Route::apiResource('/users','UserController');
Route::apiResource('/chats','ChatController');
Route::apiResource('/mensajes','MensajeController');
Route::apiResource('/chatPerfils','ChatPerfilController');
Route::apiResource('/perfils','PerfilController');


/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
