@extends('../layouts.main')

@section('title', 'Crear Gasto')

@section('content')

<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
      <li class="breadcrumb-item">
        <a class="link-body-emphasis" href="{{ route('welcome') }}">
            <i class="bi bi-house-door-fill"></i>
          <span class="visually-hidden">Home</span>
        </a>
      </li>
      <li class="breadcrumb-item">
        <a class="link-body-emphasis fw-semibold text-decoration-none" href="{{ route('gastos.index') }}">Gastos</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        Crear
      </li>
    </ol>
  </nav>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                Crear Gasto
            </div>
            <div class="card-body">
                <form action="{{ route('gastos.store') }}" method="post">
                    @csrf
                    @include('gasto._form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection