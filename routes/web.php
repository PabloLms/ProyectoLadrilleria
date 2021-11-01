<?php

use App\Http\Controllers\Administracion\EmpleadoController;
use App\Http\Controllers\Administracion\TipoEmpleadoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::prefix('tipoempleado')->group(function(){
    Route::get('/', [TipoEmpleadoController::class, 'index'])->name('tipoempleado.index');
    Route::post('/store',[TipoEmpleadoController::class, 'store'])->name('tipoempleado.store');
    Route::post('/update/{id}',[TipoEmpleadoController::class, 'update'])->name('tipoempleado.update');
    Route::post('/destroy/{id}',[TipoEmpleadoController::class, 'destroy'])->name('tipoempleado.destroy');
    Route::get('/getList',[TipoEmpleadoController::class,'getList'])->name('tipoempleado.getList');
});
Route::prefix('empleado')->group(function(){
    Route::get('/', [EmpleadoController::class, 'index'])->name('empleado.index');
    Route::get('/create', [EmpleadoController::class, 'create'])->name('empleado.create');
    Route::post('/store',[EmpleadoController::class, 'store'])->name('empleado.store');
    Route::get('/edit/{id}', [EmpleadoController::class, 'edit'])->name('empleado.edit');
    Route::post('/update/{id}',[EmpleadoController::class, 'update'])->name('empleado.update');
    Route::post('/destroy/{id}',[EmpleadoController::class, 'destroy'])->name('empleado.destroy');
    Route::get('/getList',[EmpleadoController::class,'getList'])->name('empleado.getList');
});
