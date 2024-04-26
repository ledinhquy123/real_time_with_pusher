<?php

use App\Events\UserSessionChanged;
use App\Http\Controllers\ChatController;
use App\Listeners\BroadcastUserLoginNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/users','users.show_all')->name('users.all');

Route::view('/game','game.show')->name('game.show');

Route::prefix('chat')->name('chat.')->controller(ChatController::class)->group(function() {
    Route::get('/', 'showChat')->name('showChat');

    Route::post('/message', 'messageReceived')->name('message');

    Route::post('/greet/{receiver}', 'greetReceive')->name('greet');
});