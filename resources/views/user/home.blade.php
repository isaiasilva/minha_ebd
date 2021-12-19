<h1>Página Inicial </h1>
Usuário:
{{ Auth::user()->name }}
<br>
Perfil:
{{ Auth::user()->perfil }}
<br>
Turma:
{{ $turma->nome_turma }}
<br>

Logout:
<a href="/sair">Sair</a>
<br>



<h2>Alunos</h2>
<ul>
    @foreach($alunos as $aluno)
        <li>{{ $aluno->name }}</li>
    @endforeach
</ul>


