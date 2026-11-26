<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortofolioController;

Route::get('/', [PortofolioController::class, 'home'])->name('home');
Route::get('/about', [PortofolioController::class, 'about'])->name('about');
Route::get('/services', [PortofolioController::class, 'services'])->name('services');
Route::get('/contact', [PortofolioController::class, 'contact'])->name('contact');
