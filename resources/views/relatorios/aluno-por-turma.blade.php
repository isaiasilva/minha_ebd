<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <style>
        img {
            width: 80%;
            margin-top: 2%;
        }

        .titulo {
            display: flex;
            margin-top: -6%;
            margin-left: 17% !important;
        }

        .section-border {
            padding-left: 1.5em;
            margin-right: 5%;
        }
    </style>

    <title>Turma - {{ $turma->nome_turma }}</title>
</head>

<body>
    <div class="container-fluid">
        <section class="border section-border">
            <div class="row">
                <table>
                    <tbody>
                        <tr>
                            <td class="col">
                                <img src="https://chamadaebd.com.br/img/missao-png.png" alt="Logo da MEPB">
                            </td>
                            <td class="col-8">
                                <div>
                                    <h1>Alunos por sala</h1>
                                    <h2>Sala de {{ $turma->nome_turma }}</h2>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </section>
        <section class="row alunos">
            <div class="col-11">


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Nascimento</th>
                            <th scope="col">Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alunos as $aluno)
                            <tr>
                                <td class="small">{{ $aluno->aluno->name }}</td>
                                <td class="small">{{ $aluno->aluno->email }}</td>
                                <td class="small">{{ date('d/m/Y', strtotime($aluno->aluno->data_nascimento)) }}</td>
                                <td class="small">{{ $aluno->aluno->telefone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <footer>
            <p class="small text-center">Minha EBD {{ date('Y') }}</p>
        </footer>
</body>


</html>
