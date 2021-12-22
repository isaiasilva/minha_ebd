<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\EntrarController;
use App\Http\Controllers\PrincipalController;
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
    return view('welcome');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

Route::get('/entrar', [EntrarController::class,'index']);
Route::post('/entrar', [EntrarController::class,'login']);

Route::get('/user/home', [PrincipalController::class, 'index'])->middleware(['auth'])->name('principal');
Route::get('/user/alunos', [AlunosController::class, 'index'])->middleware(['auth'])->name('alunos');
Route::get('/user/chamada', [\App\Http\Controllers\ChamadaController::class, 'index'])->middleware(['auth'])->name('chamada');
Route::post('/user/chamada', [\App\Http\Controllers\ChamadaController::class, 'create'])->middleware(['auth'])->name('chamada');

Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});




require __DIR__.'/auth.php';


