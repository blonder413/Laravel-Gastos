@extends('../layouts.main')

@section('title', 'Gastos')

@section('content')


@if (session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<div class="card">
    <div class="card-header d-flex justify-content-center">
        <h1>Gastos</h1>
    </div>
    <div class="card-body">
        <h5 class="card-title">
            <a class="btn btn-primary" href="{{ route('gastos.create') }}" title="Crear">Crear</a>
        </h5>
        <div class="card-text">
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="table-primary">
                        <td>Id</td>
                        <td>Detalle</td>
                        <td>Valor</td>
                        <td>Created</td>
                        <td>Updated</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form action="" class="form-inline" method="GET">
                            <td>
                                <button class="btn btn-outline-dark btn-sm" type="submit"><i class='bi bi-search'></i></button>
                            </td>
                            <td>
                                <input class="form-control" type="text" name="detalle" id="detalle" value="{{ $request->detalle }}">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="valor" id="valor" value="{{ $request->valor }}">
                            </td>
                            <td>
                                <input class="form-control" type="text" name="fecha" id="fecha" value="{{ $request->fecha }}">
                            </td>
                            <td></td>
                            <td>
                                <a href="{{ route('gastos.index') }}" class="btn btn-outline-primary">Limpiar</a>
                            </td>
                        </form>
                    </tr>
                    @php $total = 0 @endphp
                    @foreach($gastos as $gasto)
                    @php $total += $gasto->valor @endphp
                    <tr>
                        <td>{{ $gasto->id }}</td>
                        <td>{{ $gasto->detalle }}</td>
                        <td class="text-end">$ {{ number_format($gasto->valor, 0, ',', '.') }}</td>
                        <td>{{ $gasto->created_at }}</td>
                        <td>{{ $gasto->updated_at }}</td>
                        <td>
                            <form action="{{ route('gastos.destroy', $gasto) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('gastos.edit', $gasto) }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if ($request->detalle or $request->valor or $request->fecha)
                    <tr class="table-dark">
                        <td></td>
                        <td class="text-end">Total</td>
                        <td class="text-end">${{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-center">
        {{ $gastos->links() }}
    </div>
</div>


@endsection