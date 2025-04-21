<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-image: url('https://img.freepik.com/fotos-premium/documento-minimo-do-bloco-de-notas-da-lista-de-verificacao-ou-lista-para-tarefas-de-planejamento-com-levitacao-de-lapis-na-ilustracao-de-renderizacao-3d-no-ar_594542-141.jpg?w=826');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }

        .app-header {
            animation: fadeIn 1s ease-in-out;
        }

        .app-title {
            font-size: 4rem;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-shadow:
                0 0 5px #ffffff,
                0 0 10px #ffffff,
                0 0 10px #ffffff;
        }

        .app-subtitle {
            font-size: 2.3rem;
            color: #008cff;
            font-weight: 800;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            text-shadow:
                0 0 5px #ffffff,
                0 0 10px #ffffff,
                0 0 10px #ffffff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .app-title {
                font-size: 2.2rem;
            }

            .app-subtitle {
                font-size: 1.2rem;
            }
        }

        .dashboard-container {
            padding: 0px 15px;
        }

        .card-custom {
            background: linear-gradient(to bottom,
                    rgba(0, 74, 153, 0.4),
                    rgba(0, 74, 153, 0.6),
                    rgba(0, 3, 197, 0.7)
                );
            border: none;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.2s ease-in-out;
            height: 100%;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .icon-circle {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #17a2b8;
            color: #fff;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #f6feff;
            margin-bottom: 5px;
        }

        .card-text {
            color: #ffffff;
            font-size: 17px;
            font-weight: bold;
        }

        .equal-height {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
    </style>
</head>

<body>
    @include('components.navbar')

    <div class="app-header text-center my-5">
        <h1 class="app-title">Task Flow</h1>
        <h2 class="app-subtitle">O jeito inteligente de gerenciar seu tempo.</h2>
    </div>
    <div class="container dashboard-container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card-custom equal-height">
                    <div class="icon-circle bg-info">
                        <i data-lucide="projector"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Total de projetos</h5>
                        <p class="card-text">{{ $totalProjects }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-custom equal-height">
                    <div class="icon-circle bg-primary">
                        <i data-lucide="check-square"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Total de tarefas</h5>
                        <p class="card-text">{{ $totalTasks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-custom equal-height">
                    <div class="icon-circle bg-warning">
                        <i data-lucide="layers"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Projeto com mais tarefas</h5>
                        <ul class="card-text pl-3 mb-0">
                            @foreach ($topProjects as $project)
                                <li>{{ $project->name }} ({{ $project->tasks_count }} tarefas)</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-custom equal-height">
                    <div class="icon-circle bg-success">
                        <i data-lucide="check-circle"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Tarefas concluídas</h5>
                        <p class="card-text">{{ $completedTasks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-custom equal-height">
                    <div class="icon-circle bg-dark">
                        <i data-lucide="clock" class="text-white"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Tarefas em progresso</h5>
                        <p class="card-text">{{ $inProgressTasks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card-custom equal-height">
                    <div class="icon-circle bg-danger">
                        <i data-lucide="clock"></i>
                    </div>
                    <div>
                        <h5 class="card-title">Tarefas pendentes</h5>
                        <p class="card-text">{{ $pendingTasks }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
