@extends('../layouts.main')

@section('title', 'Gastos')

@section('content')
<div class="card">
    <h4 class="card-header text-center">Los gastos han sido los siguientes</h4>
    <div class="card-body">
        <h5 class="card-title"></h5>
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <table class="card-text table table-hover table-striped">
                    <caption>Gastos realizados</caption>
                    <thead class="table-primary">
                        <tr>
                            <th>Gasto</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gastos as $gasto)
                        <tr>
                            <td>{{ $gasto->detalle }}</td>
                            <td class="text-end">$ {{ number_format($gasto->valor, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12 col-md-6">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <p class="d-flex justify-content-center">
            <a href="{{ route('gastos.index') }}" class="btn btn-primary" title="Ir a gastos">Ir a gastos</a>
        </p>
    </div>
    @php
    if ($total < 2000000) {
        $class = 'text-success';
    } elseif ($total < 4000000) {
        $class = 'text-warning';
    } else {
        $class = 'text-danger';
    }
    @endphp
    <div class="card-footer text-body-secondary d-flex justify-content-center {{ $class }} fw-bold">
        $ {{ number_format($total, 0, ',', '.') }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const datos = <?= json_encode($gastos_grafico) ?>;
    let fechas = [];
    let valores = [];
    for (let i = 0; i < datos.length; i++) {
        fechas[i] = datos[i].mes;
        valores[i] = datos[i].total;
    }
    // https://www.chartjs.org/docs/latest/
    const myChart = new Chart(ctx, {
            type: 'bar',    // bar, line, doughnut, pie, radar
            data: {
                labels: fechas,
                datasets: [
                    {
                        //barPercentage: 0.5,
                        //categoryPercentage: 0.5,
                        label: 'Pesos',
                        data: valores,
                        backgroundColor: [
                            //'rgba(255, 99, 132, 0.2)',  // rojo
                            //'rgba(54, 162, 235, 0.2)',  // azul
                            'rgba(255, 206, 86, 0.2)',  // amarillo
                            //'rgba(75, 192, 192, 0.2)',  // verde
                            //'rgba(153, 102, 255, 0.2)', // violeta
                            //'rgba(255, 159, 64, 0.2)'   // naranja
                        ],
                        borderColor: [
                            //'rgba(255, 99, 132, 1)',
                            //'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            //'rgba(75, 192, 192, 1)',
                            //'rgba(153, 102, 255, 1)',
                            //'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        barThickness: 50,
                        maxBarThickness: 75,
                        minBarLength: 35,
                    },
                ]
            },
            options: {
                //animations: {               // para tipo line
                //    tension: {
                //        duration: 1000,
                //        easing: 'linear',
                //        from: 1,
                //        to: 0,
                //        loop: true
                //    }
                //},
                // animation: true,
                //aspectRatio: 1,
                //indexAxis: 'y',
                maintainAspectRatio: true,
                //spanGaps: true,   // para tipo line
                //showLine: false,  // para tipo line
                parsing: {
                    yAxisKey: 'Gastos',
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Gastos del último año'
                    }
                },
                scales: {
                    x:{
                        // stacked: true,      // poner ambos arreglos en una sola barra, usar en ambos ejes
                        grid: {
                            display: false  // ocultar las líneas guía
                        }
                    },
                    y: {
                        //beginAtZero: true,
                        // stacked: true,      // poner ambos arreglos en una sola barra, usar en ambos ejes
                        grid: {
                            display: false  // ocultar las líneas guía
                        },
                        ticks: {
                            display: true  // ocultar las etiquetas del eje y
                        }
                    },
                }
            },
            // plugins: [ChartDataLabels]
        });
</script>
@endsection
