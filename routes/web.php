<?php

use App\Http\Controllers\Item\CreateController as ItemCreateController;
use App\Http\Controllers\Question\CreateController;
use App\Http\Controllers\Quiz\DeleteQuizController;
use App\Http\Controllers\{AlterarSenhaController, AlunosPorTurmaController, PdfController, PerfilController, PrincipalController, ProfessorPorTurmaController, TurmaController, UsuariosController, VisualizarChamadasController};
use App\Livewire\Administrator\User\Register as UserRegister;
use App\Livewire\Church\{Create, Edit, Index, Show};
use App\Livewire\Class\Index as ClassIndex;
use App\Livewire\Material\{Create as MaterialCreate, Edit as MaterialEdit, Index as MaterialIndex, Show as MaterialShow};
use App\Livewire\Quiz\Item\Create as ItemCreate;
use App\Livewire\Quiz\Question\{Create as QuestionCreate, Show as QuestionShow};
use App\Livewire\Quiz\{Create as QuizCreate, Index as QuizIndex, Show as QuizShow};
use App\Livewire\Student\{Create as StudentCreate, Index as StudentIndex};
use App\Livewire\User\{Edit as UserEdit, Index as UserIndex, Profile, Register};
use App\Livewire\{Chamada, Relatorios};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('principal');
    }

    return view('auth.login');
});

Route::get('/entrar', function () {
    if (Auth::check()) {
        return redirect()->route('principal');
    }

    return view('auth.login');
})->name("entrar");

Route::get('/user/home', [PrincipalController::class, 'index'])->middleware(['auth'])->name('principal');

Route::get('/user/usuarios', UserIndex::class)->middleware(['auth'])->name('usuarios');
Route::delete('/user/{id}/delete', [UsuariosController::class, 'destroy'])->middleware(['auth'])->name('delete.user');
Route::get('/user/usuario/{id}/editar', UserEdit::class)->name('user.edit')->middleware(['auth']);
Route::put('/user/usuario/{id}/editar', [UsuariosController::class, 'update'])->middleware(['auth']);

Route::get('/user/chamada', Chamada::class)->middleware(['auth'])->name('chamada');
Route::get('/user/chamada/{id}', Chamada::class)->middleware(['auth']);

Route::get('/user/visualizar-chamadas/', [VisualizarChamadasController::class, 'create'])->middleware(['auth'])->name('visualizar-chamadas');
Route::get('/user/visualizar-chamadas-por-turma/', [VisualizarChamadasController::class, 'chamadas'])->middleware(['auth'])->name('todas-chamadas');
Route::get('/user/visualizar-chamadas-por-turma/{id}', [VisualizarChamadasController::class, 'chamadas'])->middleware(['auth']);
Route::get('/user/turmas', ClassIndex::class)->middleware(['auth'])->name('turmas');

Route::get('/user/turma', [TurmaController::class, 'create'])->middleware(['auth'])->name('turma.create');
Route::post('/user/turma', [TurmaController::class, 'store'])->middleware(['auth'])->name('turma.store');
Route::get('/user/turma/{id}/editar', [TurmaController::class, 'editar'])->middleware(['auth'])->name('turma.edit');
Route::put('/user/turma/{id}/editar', [TurmaController::class, 'update'])->middleware(['auth'])->name('turma.update');
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

Route::prefix('user/quiz')->name('quiz.')->group(function () {
    Route::get('/', QuizIndex::class)->middleware(['auth'])->name('index');
    Route::get('create', QuizCreate::class)->name('create')->middleware(['auth']);
    Route::get('show/{quiz}', QuizShow::class)->name('show')->middleware(['auth']);
    //Route::get('edit/{material}', MaterialEdit::class)->name('edit')->middleware(['auth']);
    Route::delete('delete/{quiz}', DeleteQuizController::class)->name('delete')->middleware(['auth']);
});

Route::get('/user/quiz/{quiz}/question/{question}/show', QuestionShow::class)->name('question.show')->middleware(['auth'])->lazy();
Route::get('/user/quiz/{quiz}/question/create', QuestionCreate::class)->name('question.create')->middleware(['auth'])->lazy();
Route::post('/user/quiz/{quiz}/question/create', CreateController::class)->name('question.store')->middleware(['auth']);

Route::get('/user/quiz/{quiz}/question/{question}/item/create', ItemCreate::class)->name('item.create')->middleware(['auth'])->lazy();
Route::post('/user/quiz/{quiz}/question/{question}/item/create', ItemCreateController::class)->name('item.store')->middleware(['auth'])->lazy();

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
