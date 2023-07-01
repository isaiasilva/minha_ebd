<?php

use App\Http\Controllers\{AlterarSenhaController, AlunosController, AlunosPorTurmaController, ChamadaController, EntrarController, PdfController, PerfilController, PrincipalController, ProfessorPorTurmaController, TurmaController, UsuariosController, VisualizarChamadasController};
use App\Http\Livewire\Administrator\User\Register as UserRegister;
use App\Http\Livewire\Church\{Create, Edit, Index, Show};
use App\Http\Livewire\Material\{Create as MaterialCreate, Edit as MaterialEdit, Index as MaterialIndex, Show as MaterialShow};
use App\Http\Livewire\Student\{Create as StudentCreate, Index as StudentIndex};
use App\Http\Livewire\User\{Edit as UserEdit, Index as UserIndex, Profile, Register};
use App\Http\Livewire\{Chamada, Relatorios, UserTable};
use App\Models\{User, UsuariosPorIgreja};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('principal');
    }

    return view('auth.login');
});

Route::get('/entrar', [EntrarController::class, 'index'])->name("entrar");
Route::post('/entrar', [EntrarController::class, 'login']);

Route::get('/user/home', [PrincipalController::class, 'index'])->middleware(['auth'])->name('principal');

Route::get('/user/usuarios', UserIndex::class)->middleware(['auth'])->name('usuarios');
Route::delete('/user/{id}/delete', [UsuariosController::class, 'destroy'])->middleware(['auth'])->name('delete.user');
Route::get('/user/usuario/{id}/editar', UserEdit::class)->name('user.edit')->middleware(['auth']);
Route::put('/user/usuario/{id}/editar', [UsuariosController::class, 'update'])->middleware(['auth']);

Route::get('/user/alunos', [AlunosController::class, 'index'])->middleware(['auth'])->name('alunos');

Route::get('/user/chamada', Chamada::class)->middleware(['auth'])->name('chamada');

Route::get('/user/chamada/{id}', Chamada::class)->middleware(['auth']);

Route::post('/user/chamada', [ChamadaController::class, 'create'])->middleware(['auth'])->name('chamada');
Route::post('/user/atraso', [ChamadaController::class, 'create'])->middleware(['auth'])->name('atraso');
Route::get('/user/excluir-presenca/{turma}/{aluno}', [ChamadaController::class, 'destroy'])->middleware(['auth'])->name('excluir-presenca');

Route::get('/user/visualizar-chamadas/', [VisualizarChamadasController::class, 'create'])->middleware(['auth'])->name('visualizar-chamadas');
Route::get('/user/visualizar-chamadas-por-turma/', [VisualizarChamadasController::class, 'chamadas'])->middleware(['auth'])->name('todas-chamadas');
Route::get('/user/visualizar-chamadas-por-turma/{id}', [VisualizarChamadasController::class, 'chamadas'])->middleware(['auth']);

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

Route::get('/user/aluno-por-turma', StudentIndex::class)->middleware(['auth'])->name('alunoPorTurma');
Route::get('/user/associar-aluno', StudentCreate::class)->middleware(['auth'])->name('associar-aluno');
Route::post('/user/associar-aluno', [AlunosPorTurmaController::class, 'store'])->middleware(['auth']);
Route::post('/user/excluir-aluno', [AlunosPorTurmaController::class, 'destroy'])->middleware(['auth'])->name('excluir-aluno');

Route::get('/user/perfil', Profile::class)->middleware(['auth'])->name('perfil');
Route::put('/user/perfil', [PerfilController::class, 'UPDATE'])->middleware(['auth']);

Route::get('/user/alterar-senha', [AlterarSenhaController::class, 'create'])->name('alterar-senha');
Route::post('/user/alterar-senha', [AlterarSenhaController::class, 'store'])->name('alterar-senha');

Route::get('/user/alunos-por-turma/', Relatorios::class)->middleware(['auth'])->name('alunos.relatorio');
Route::post('/alunos/pdf/', [PdfController::class, 'alunosPorTurma'])->middleware(['auth'])->name('alunos-por-turma');

Route::get('/registrar-usuario', Register::class)->name('registrar.index')->middleware(['auth']);
Route::get('/igrejas', Index::class)->name('igrejas.index')->middleware(['auth']);
Route::get('/igrejas/novo', Create::class)->name('igrejas.create')->middleware(['auth']);
Route::get('/igrejas/editar/{id}', Edit::class)->name('igrejas.edit')->middleware(['auth']);
Route::get('/igrejas/{id}', Show::class)->name('igrejas.show')->middleware(['auth']);

Route::prefix('user/material')->name('material.')->group(function () {
    Route::get('/', MaterialIndex::class)->middleware(['auth'])->name('index');
    Route::get('create', MaterialCreate::class)->name('create')->middleware(['auth']);
    Route::get('show/{material}', MaterialShow::class)->name('show')->middleware(['auth']);
    Route::get('edit/{material}', MaterialEdit::class)->name('edit')->middleware(['auth']);
});

Route::get('/users/data-table', UserTable::class)->middleware('auth');

Route::get('/sair', function () {
    Auth::logout();

    return redirect('/entrar');
});

Route::get('/register', UserRegister::class)->name('register')->middleware(['auth']);

Route::get('/gameficacao', function () {
    toastr()->addInfo('Função em desenvolvimento', 'Aguarde!');

    return back();
})->name('gamiicacao')->middleware('auth');

require __DIR__ . '/auth.php';
