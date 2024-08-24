<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::get('/', [SessionController::class, 'initR'])->name('session.initR');

Route::get('/initR', [SessionController::class, 'initR'])->name('session.initR');
Route::get('/initL', [SessionController::class, 'initL'])->name('login');
Route::post('/register', [SessionController::class, 'register'])->name('session.register');
Route::post('/login', [SessionController::class, 'login'])->name('session.login');

Route::get('/pay', [SessionController::class, 'pay'])->name('pay.show');
Route::put('/pay-process', [SessionController::class, 'payProcess'])->name('pay.process');
Route::get('/pay-overpay', [SessionController::class, 'payOverpay'])->name('pay.overpay');
Route::put('/handle-overpay', [SessionController::class, 'handleOverpay'])->name('pay.handleOverpay');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth', 'paid'])->group(function(){
    Route::post('/friend-request', [FriendController::class, 'friendRequest'])->name('friend.request');
    Route::get('/request-view', [FriendController::class, 'requestView'])->name('friend.request_view');
    Route::get('/friends', [FriendController::class, 'friends'])->name('friend.index');

    Route::get('/chat/process', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');

    Route::get('/profile', [HomeController::class, 'profile'])->name('user.profile');
    Route::post('/profile/logout', [SessionController::class, 'logout'])->name('user.logout');

    Route::post('/friend-detail', [FriendController::class, 'friendDetail'])->name('friend.detail');
});

Route::get('/locale/{loc}', function ($loc) {
    Session::put('locale', $loc);
    return redirect()->back();
})->name('locale');
