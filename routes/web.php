<?php

use App\Models\User;
use App\Http\Livewire\Relatorios;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\EntrarController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ChamadaController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\AlterarSenhaController;
use App\Http\Controllers\AlunosPorTurmaController;
use App\Http\Controllers\ProfessorPorTurmaController;
use App\Http\Controllers\VisualizarChamadasController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Livewire\Administrator\User\Register as UserRegister;
use App\Http\Livewire\Chamada;
use App\Http\Livewire\Church\Create;
use App\Http\Livewire\Church\Index;
use App\Http\Livewire\User\Register;
use App\Models\UsuariosPorIgreja;

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


Route::get('/entrar', [EntrarController::class, 'index'])->name("entrar");
Route::post('/entrar', [EntrarController::class, 'login']);

Route::get('/user/home', [PrincipalController::class, 'index'])->middleware(['auth'])->name('principal');

Route::get('/user/usuarios', [UsuariosController::class, 'index'])->middleware(['auth'])->name('usuarios');
Route::delete('/user/{id}/delete', [UsuariosController::class, 'destroy'])->middleware(['auth'])->name('delete.user');
Route::get('/user/usuario/{id}/editar', [UsuariosController::class, 'editarUsuario'])->middleware(['auth']);
Route::put('/user/usuario/{id}/editar', [UsuariosController::class, 'update'])->middleware(['auth']);

Route::get('/user/alunos', [AlunosController::class, 'index'])->middleware(['auth'])->name('alunos');

Route::get('/user/chamada', Chamada::class)->middleware(['auth'])->name('chamada');

Route::get('/user/chamada/{id}', Chamada::class)->middleware(['auth']);

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

Route::get('/user/aluno-por-turma', [AlunosPorTurmaController::class, 'index'])->middleware(['auth'])->name('alunoPorTurma');
Route::get('/user/associar-aluno', [AlunosPorTurmaController::class, 'create'])->middleware(['auth'])->name('associar-aluno');
Route::post('/user/associar-aluno', [AlunosPorTurmaController::class, 'store'])->middleware(['auth']);
Route::post('/user/excluir-aluno', [AlunosPorTurmaController::class, 'destroy'])->middleware(['auth'])->name('excluir-aluno');


Route::get('/user/perfil', [PerfilController::class, 'index'])->middleware(['auth'])->name('perfil');
Route::put('/user/perfil', [PerfilController::class, 'UPDATE'])->middleware(['auth']);


Route::get('/user/alterar-senha', [AlterarSenhaController::class, 'create'])->name('alterar-senha');
Route::post('/user/alterar-senha', [AlterarSenhaController::class, 'store'])->name('alterar-senha');

Route::get('/user/alunos-por-turma/', Relatorios::class)->middleware(['auth'])->name('alunos.relatorio');
Route::post('/alunos/pdf/', [PdfController::class, 'alunosPorTurma'])->middleware(['auth'])->name('alunos-por-turma');

Route::get('/registrar-usuario', Register::class)->name('registrar.index')->middleware(['auth']);
Route::get('/igrejas', Index::class)->name('igrejas.index')->middleware(['auth']);
Route::get('/igrejas/novo', Create::class)->name('igrejas.create')->middleware(['auth']);

Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});

Route::get('/register', UserRegister::class)->name('register')->middleware(['auth']);




require __DIR__ . '/auth.php';
