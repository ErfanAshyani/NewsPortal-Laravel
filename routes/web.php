<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend;

Route::get('/',[Frontend\HomeController::class,'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('language', LanguageController::class)->name('language');
Route::get('news-details/{slug}', [HomeController::class, 'ShowNews'])->name('news-details');
Route::get('news', [HomeController::class, 'news'])->name('news');
/** News Details Routes */
Route::get('news', [HomeController::class, 'news'])->name('news');
Route::post('news-comment', [HomeController::class, 'handleComment'])->name('news-comment');
Route::post('news-comment-replay', [HomeController::class, 'handleReplay'])->name('news-comment-replay');
Route::delete('news-comment-destroy', [HomeController::class, 'commentDestory'])->name('news-comment-destroy');
Route::post('subscribe-newsletter', [HomeController::class, 'SubscribeNewsLetter'])->name('subscribe-newsletter');
/** About Page Route */
Route::get('about', [HomeController::class, 'about'])->name('about');

/** Contact Page Route */
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
/** Contact Page Route */
Route::post('contact', [HomeController::class, 'handleContactFrom'])->name('contact.submit');
require __DIR__.'/auth.php';

