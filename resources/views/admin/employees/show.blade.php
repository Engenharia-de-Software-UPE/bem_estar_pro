@extends('admin.layouts.default')

@section('title', 'BemEstar Pro - Funcionários')

@section('content')
    <h1 class="fs-2 mb-4">Histório de funcionário</h1>

    <h2 class="fs-5 mb-4">Nome do funcionário</h2>

    <section class="dados-funcionario">
        <table class="table mb-5">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Idade</th>
                    <th>Função</th>
                    <th>Departamento</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <th class="text-center">{{ $employee->id }}</th>
                    <td class="text-center">{{ $employee->name }}</td>
                    <td class="text-center">{{ $employee->role }}</td>
                    <td class="text-center">{{ $employee->department->name }}</td>
                </tr>
            </tbody>
        </table>
    </section>

    <h2 class="fs-4 mb-4">Gráfico de avaliações</h2>

    <section class="grafico-avaliacoes mb-5 bg-light p-4 rounded-3">
        <canvas id="myChart" style="width: 100%; height: 300px;"></canvas>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
            labels: <?php echo json_encode($datas); ?>,  // Data (labels)
            datasets: [{
                label: 'Média',
                // Dados das médias gerados dinamicamente no PHP
                data: <?php echo json_encode($medias); ?>,  // Médias
                borderWidth: 3
            }]
        },
            options: {
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    y: {
                        min: 1,
                        max: 5,
                    }
                }
            }
        });
    </script>

    <h2 class="fs-4 mb-4">Histório de avaliações</h2>

    <section class="historico-avaliacoes mb-5 bg-light p-3 rounded-4">
        <table class="table">
            <thead class="table-secondary">
                <tr class="text-center">
                    <th>Data avaliação</th>
                    <th>Média</th>
                    <th width="80">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questionnaireDates as $test)
                <tr class="align-middle">
                    <td>{{ $test->created_at }}</td>
                    <td>
                        {{ $test->averageScore }}
                        <img src="/images/icon_1.png"> Muito Satisfeito
                    </td>
                    <td>
                        <a href="{{ route('employees.test.details', $test->id) }}" title="Detalhar" class="btn btn-primary">
                            <i class="bi bi-card-list"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection
