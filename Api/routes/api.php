<?php

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

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/create-mail',[\App\Http\Controllers\MailController::class, 'createMail']);
Route::get('/get-mails',[\App\Http\Controllers\MailController::class,'getMailList']);
Route::get('/get-mail/{uuid}',[\App\Http\Controllers\MailController::class,'getSingleMail']);
Route::get('/get-reciepients-mails/{getReciepientEmail}',[\App\Http\Controllers\MailController::class,
    'getMailsRelatedToReciepients']);





