<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('tasks');
    })->name('main');

    Route::resource('tasks', TaskController::class)
        ->middleware(['auth', 'verified']);
});
