<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\RespuestaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/loginTokens',[UserController::class,"loginTokens"]);
Route::post('/login',[AuthController::class,"login"])->name('login');
//Route::post('/loginTokens', 'UserController@loginTokens');
Route::post('/register',[AuthController::class,"register"]);

Route::group(['middleware'=>'auth:api'], function (){

    Route::resource("preguntas", PreguntaController::class);
    Route::resource("respuestas", RespuestaController::class);
    Route::post('/preguntas/{id}/encuestas', [PreguntaController::class, "store"]);
    Route::post("/respuestas/archivoStore",[RespuestaController::class, "archivoStore"]);
    Route::post("/respuestas/{id}/archivoUpdate",[RespuestaController::class, "archivoUpdate"]);

});
Route::resource("encuestas",EncuestaController::class);
Route::resource("preguntas",PreguntaController::class);
Route::resource("respuestas", RespuestaController::class);
