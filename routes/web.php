<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TimeController;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::middleware(['auth:sanctum', 'verified'])->group(function(Router $router){
  $router->post('/create-client', [ClientController::class, 'store'])->name('create-client');
  $router->get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
  $router->get('/clients/{id}', [ClientController::class, 'view'])->name('view-client');
  $router->post('/create-task', [TaskController::class, 'store'])->name('create-task');
  $router->get('/task/{id}/log', [TimeController::class, 'show'])->name('log-time');
});



Route::middleware(['auth:sanctum', 'verified'])->prefix('local')->group(function(Router $router){
    $router->get('/client/{clientId}/billed', [ClientController::class, 'billed']);
});
