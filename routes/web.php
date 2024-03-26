<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ClientController;

use App\Http\Controllers\TrainerController;


use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\TrainingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/clients', [ClientController::class, 'index']);


// Trainers
Route::prefix('trainers')->group(function () {
Route::get('/', [TrainerController::class, 'index'])->name('trainers.index');
Route::get('/create', [TrainerController::class, 'create'])->name('trainers.create');
Route::post('/store', [TrainerController::class, 'store'])->name('trainers.store');
Route::get('/{id}', [TrainerController::class, 'show'])->name('trainers.show');
Route::get('/{id}/edit', [TrainerController::class, 'edit'])->name('trainers.edit');
Route::post('/{id}/update', [TrainerController::class, 'update'])->name('trainers.update');
Route::post('/{id}/destroy', [TrainerController::class, 'destroy'])->name('trainers.destroy');
});


// Halls
Route::prefix('halls')->group(function () {
    Route::get('/', [HallController::class, 'index'])->name('halls.index');
    Route::get('/create', [HallController::class, 'create'])->name('halls.create');
    Route::post('/store', [HallController::class, 'store'])->name('halls.store');
    Route::get('/{id}', [HallController::class, 'show'])->name('halls.show');
    Route::get('/{id}/edit', [HallController::class, 'edit'])->name('halls.edit');
    Route::post('/{id}/update', [HallController::class, 'update'])->name('halls.update');
    Route::post('/{id}/destroy', [HallController::class, 'destroy'])->name('halls.destroy');
});


// Groups
Route::prefix('groups')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/store', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/{id}', [GroupController::class, 'show'])->name('groups.show');
    Route::get('/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::post('/{id}/update', [GroupController::class, 'update'])->name('groups.update');
    Route::post('/{id}/destroy', [GroupController::class, 'destroy'])->name('groups.destroy');
});

// Clients
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/{id}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::post('/{id}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
});




// Route::resource('administrators', AdministratorController::class);
Route::resource('managers', ManagerController::class);
Route::resource('halls', HallController::class);
Route::resource('times', TimeController::class);
Route::resource('salaries', SalaryController::class);
Route::resource('training_types', TrainingTypeController::class);



//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');





Route::get('/', function () {
    return view('welcome');
});


// Route::get('/', function () {
//     return view('trainer');
// });



// Route::get('/', function () {
//     return view('client');
// });
