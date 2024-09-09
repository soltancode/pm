<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');