<h1>Página Inicial </h1>
usuário:
{{ Auth::user()->name }}
<br>
perfil:
{{ Auth::user()->perfil }}
Turma:

{{ $turma->nome_turma }}
