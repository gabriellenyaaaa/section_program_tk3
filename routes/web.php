<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('todo.index');
Route::get('/create', [TodoController::class, 'create'])->name('todo.create');
Route::post('/store', [TodoController::class, 'store'])->name('todo.store');
Route::patch('/toggle/{id}', [TodoController::class, 'toggleDone'])->name('todo.toggle');
Route::delete('/delete/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
