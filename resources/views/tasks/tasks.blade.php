<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
    <link rel="icon" href="https://cdn-icons-png.freepik.com/256/17790/17790807.png?uid=R81172538&ga=GA1.1.487095378.1743434307&semt=ais_hybrid" type="image/jpeg">
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
        <h2>Lista de Tarefas</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-message">
                {{ session('success') }}
            </div>
        @endif
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Nova Tarefa</button>
        <button class="btn btn-info mb-3" data-toggle="modal" data-target="#filtersModal">Filtros</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-danger mb-3">
            <i class="fas fa-undo"></i>
        </a>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Data Limite</th>
                        <th>Projeto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tasks->count())
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $task->status)) }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->project->name ?? 'Sem Projeto' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning m-1" data-toggle="modal"
                                        data-target="#editModal{{ $task->id }}">
                                        <i class="fas fa-edit"> Editar</i>
                                    </button>
                                    <button class="btn btn-sm btn-danger m-1" data-toggle="modal"
                                        data-target="#deleteModal{{ $task->id }}">
                                        <i class="fas fa-trash-alt"> Excluir</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma tarefa encontrada com os filtros aplicados.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $tasks->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modal Filtros -->
    <div class="modal fade" id="filtersModal" tabindex="-1" role="dialog" aria-labelledby="filtersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('tasks.index') }}" method="GET" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filtersModalLabel">Filtros de Tarefas</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control" value="{{ request('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="">Todos</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendente
                            </option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Em
                                Progresso</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                Concluído</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="project_id">Projeto</label>
                        <select name="project_id" class="form-control">
                            <option value="">Todos</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Criação -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nova Tarefa</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="pending">Pendente</option>
                            <option value="in_progress">Em Progresso</option>
                            <option value="completed">Concluído</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data Limite</label>
                        <input type="date" name="due_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Projeto</label>
                        <select name="project_id" class="form-control">
                            <option value="">Sem Projeto</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Criar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modais de edição e exclusão -->
    @if ($tasks->count())
        @foreach ($tasks as $task)
            <!-- Modal Editar -->
            <div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="modal-content">
                        @csrf @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $task->id }}">Editar Tarefa</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $task->title }}" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                        Pendente</option>
                                    <option value="in_progress"
                                        {{ $task->status == 'in_progress' ? 'selected' : '' }}>Em Progresso</option>
                                    <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                        Concluído</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Data Limite</label>
                                <input type="date" name="due_date" class="form-control"
                                    value="{{ $task->due_date }}" required>
                            </div>
                            <div class="form-group">
                                <label>Projeto</label>
                                <select name="project_id" class="form-control">
                                    <option value="">Sem Projeto</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                            {{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Deletar -->
            <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="modal-content">
                        @csrf @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Excluir Tarefa</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir <strong>{{ $task->title }}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endif

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
