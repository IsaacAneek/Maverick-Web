<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use \App\Models\Space;

Route::get('/', function () {
    return view('login');
});

Route::middleware('checkLogin')->group(function () {
    Route::get('/dashboard', function () {

        $space = Space::where('username', session('username'))->first();

        if (!$space) {
            return view('dashboard', [
                'spaces' => collect(),
                'selectedSpace' => null,
                'todoTasks' => collect(),
                'ongoingTasks' => collect(),
                'doneTasks' => collect(),
            ]);
        }

        return redirect()->route('dashboard', $space->space_id);

    });

    Route::get('/dashboard/spaces/{space}', [DashboardController::class, 'show'])->name('dashboard');

    Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');

    Route::post('/dashboard/action', [DashboardController::class, 'action'])->name('dashboard.action');

    Route::post('/space/add', [DashboardController::class, 'addSpace'])->name('space.add');

    Route::post('/spaces/{space}/todo/add',[DashboardController::class, 'addTodo'])->name('todo.add');

    Route::post('/spaces/{space}/ongoing/add',[DashboardController::class, 'addOngoing'])->name('ongoing.add');

    Route::post('/spaces/{space}/done/add',[DashboardController::class, 'addDone'])->name('done.add');

    Route::post('/task/{task}/move-left', [DashboardController::class, 'moveTaskLeft'])
    ->name('task.moveLeft');

    Route::post('/task/{task}/move-right', [DashboardController::class, 'moveTaskRight'])
    ->name('task.moveRight');

    Route::delete('/task/{task}', [DashboardController::class, 'deleteTask'])
    ->name('task.delete');

});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);