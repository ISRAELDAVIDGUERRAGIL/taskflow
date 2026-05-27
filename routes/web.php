<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $projects = auth()->user()->projects()->withCount('tasks')->get();
    $pendingTasks = auth()->user()->projects()->withWhereHas('tasks', function ($q) {
        $q->where('status', 'Pendiente');
    })->get()->pluck('tasks')->flatten();

    return view('dashboard', compact('projects', 'pendingTasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);
    Route::resource('projects.tasks', TaskController::class)->shallow();
});

require __DIR__.'/auth.php';
