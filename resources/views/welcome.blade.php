@extends('../layouts.main')

@section('title', 'Gastos')

@section('content')
<div class="card">
    <h4 class="card-header text-center">Los gastos han sido los siguientes</h4>
    <div class="card-body">
        <h5 class="card-title"></h5>
        <div class="row">
        <div class="col-sm-12 col-md-3"></div>
        <div class="col-sm-12 col-md-6 mb-3">
            <table class="card-text table table-hover table-striped">
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
        <div class="col-sm-12 col-md-3"></div>
        </div>
        <p class="d-flex justify-content-center">
            <a href="{{ route('gastos.index') }}" class="btn btn-primary" title="Ir a gastos">Ir a gastos</a>
        </p>
    </div>
    @php
    if ($total < 2000) {
        $class = 'text-success';
    } elseif ($total < 4000) {
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
