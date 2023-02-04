<?php

use App\Http\Controllers\AlterarSenhaController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\AlunosPorTurmaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChamadaController;
use App\Http\Controllers\EntrarController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ProfessorPorTurmaController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VisualizarChamadasController;
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
    return view('auth.login');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/

Route::get('/entrar', [EntrarController::class, 'index'])->name("entrar");
Route::post('/entrar', [EntrarController::class, 'login']);

Route::get('/user/home', [PrincipalController::class, 'index'])->middleware(['auth'])->name('principal');

Route::get('/user/usuarios', [UsuariosController::class, 'index'])->middleware(['auth'])->name('usuarios');
Route::get('/user/usuario/{id}', [UsuariosController::class, 'destroy'])->middleware(['auth']);
Route::get('/user/usuario/{id}/editar', [UsuariosController::class, 'editarUsuario'])->middleware(['auth']);
Route::put('/user/usuario/{id}/editar', [UsuariosController::class, 'update'])->middleware(['auth']);

Route::get('/user/alunos', [AlunosController::class, 'index'])->middleware(['auth'])->name('alunos');

Route::get('/user/chamada', [ChamadaController::class, 'index'])->middleware(['auth'])->name('chamada');
Route::get('/user/chamada/{id}', [ChamadaController::class, 'index'])->middleware(['auth']);

Route::post('/user/chamada', [ChamadaController::class, 'create'])->middleware(['auth'])->name('chamada');
Route::post('/user/atraso', [ChamadaController::class, 'create'])->middleware(['auth'])->name('atraso');
//Route::post('/user/excluir-presenca', [ChamadaController::class, 'destroy'])->middleware(['auth'])->name('excluir-presenca');
Route::get('/user/excluir-presenca/{turma}/{aluno}', [ChamadaController::class, 'destroy'])->middleware(['auth'])->name('excluir-presenca');

Route::get('/user/visualizar-chamadas/', [VisualizarChamadasController::class, 'create'])->middleware(['auth'])->name('visualizar-chamadas');
Route::get('/user/visualizar-chamadas-por-turma/', [VisualizarChamadasController::class, 'todasChamadas'])->middleware(['auth'])->name('todas-chamadas');
Route::get('/user/visualizar-chamadas-por-turma/{id}', [VisualizarChamadasController::class, 'chamadasPorTurma'])->middleware(['auth']);

Route::get('/user/turmas', [TurmaController::class, 'index'])->middleware(['auth'])->name('turmas');

Route::get('/user/turma', [TurmaController::class, 'create'])->middleware(['auth'])->name('turma');
Route::post('/user/turma', [TurmaController::class, 'store'])->middleware(['auth']);
Route::get('/user/turma/{id}/editar', [TurmaController::class, 'editar'])->middleware(['auth']);
Route::put('/user/turma/{id}/editar', [TurmaController::class, 'update'])->middleware(['auth']);
Route::delete('/user/excluir-turma', [TurmaController::class, 'destroy'])->middleware(['auth'])->name('excluir-turma');

Route::get('/user/professor-por-turma', [ProfessorPorTurmaController::class, 'index'])->middleware(['auth'])->name('professorPorTurma');
Route::get('/user/associar-professor', [ProfessorPorTurmaController::class, 'create'])->middleware(['auth'])->name('associar-professor');
Route::post('/user/associar-professor', [ProfessorPorTurmaController::class, 'store'])->middleware(['auth']);
Route::get('/user/atualiza-turma/{id}', [ProfessorPorTurmaController::class, 'atualizaTurma'])->middleware(['auth']);
Route::post('/user/excluir-professor', [ProfessorPorTurmaController::class, 'destroy'])->middleware(['auth'])->name('excluir-professor');

Route::get('/user/aluno-por-turma/popular', [AlunosPorTurmaController::class, 'populaNames'])->middleware(['auth'])->name('populaNames');
Route::get('/user/aluno-por-turma', [AlunosPorTurmaController::class, 'index'])->middleware(['auth'])->name('alunoPorTurma');
Route::get('/user/associar-aluno', [AlunosPorTurmaController::class, 'create'])->middleware(['auth'])->name('associar-aluno');
Route::post('/user/associar-aluno', [AlunosPorTurmaController::class, 'store'])->middleware(['auth']);
Route::post('/user/excluir-aluno', [AlunosPorTurmaController::class, 'destroy'])->middleware(['auth'])->name('excluir-aluno');


Route::get('/user/perfil', [PerfilController::class, 'index'])->middleware(['auth'])->name('perfil');
Route::put('/user/perfil', [PerfilController::class, 'UPDATE'])->middleware(['auth']);


Route::get('/user/alterar-senha', [AlterarSenhaController::class, 'create'])->name('alterar-senha');
Route::post('/user/alterar-senha', [AlterarSenhaController::class, 'store'])->name('alterar-senha');

Route::get('/alunos/pdf', [PdfController::class, 'alunosPorTurma']);


Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});




require __DIR__ . '/auth.php';
