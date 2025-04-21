<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projetos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://img.freepik.com/fotos-premium/documento-minimo-do-bloco-de-notas-da-lista-de-verificacao-ou-lista-para-tarefas-de-planejamento-com-levitacao-de-lapis-na-ilustracao-de-renderizacao-3d-no-ar_594542-141.jpg?w=826');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        table.table-bordered {
            border-collapse: collapse;
        }

        table.table-bordered th,
        table.table-bordered td {
            border: 1px solid rgb(116, 116, 116) !important;
            background-color: rgba(255, 255, 255, 0.692);
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container mt-5">
        <h2>Lista de Projetos</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Novo Projeto</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <button href="#" class="btn btn-warning btn-sm m-1" data-toggle="modal" data-target="#editModal{{ $project->id }}">
                                <i class="fas fa-edit"> Editar</i>
                            </button>
                            <button href="#" class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#deleteModal{{ $project->id }}">
                                <i class="fas fa-trash-alt"> Excluir</i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de Edição -->
                    <div class="modal fade" id="editModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar Projeto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name">Nome do Projeto</label>
                                            <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Exclusão -->
                    <div class="modal fade" id="deleteModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Excluir Projeto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>Tem certeza que deseja excluir este projeto?</p>
                                    <strong>{{ $project->name }}</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="d-flex justify-content-center">
            {{ $projects->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Modal de Criação de Projeto -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('projects.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Novo Projeto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nome do Projeto</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Criar Projeto</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-message').alert('close');
            }, 4000);
        });
    </script>
</body>
</html>
