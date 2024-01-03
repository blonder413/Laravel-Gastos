@csrf

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon-fill"></i> Por favor solucione los siguientes problemas
        <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error}}</li>
        @endforeach
        </ul>

        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="mb-3">
    <label for="detalle">Detalle</label>
    <input type="text" name="detalle" id="detalle" class="form-control {{ $errors->has('detalle') ? 'is-invalid' : '' }}" placeholder="Detalle" title="Detalle" value="{{ old('detalle', $gasto->detalle ?? '') }}">
    <span class="text-danger">{{ $errors->first('detalle') }}</span>
</div>
<div class="mb-3">
    <label for="valor">Valor</label>
    <input type="number"  min="0" name="valor" id="valor" class="form-control {{ $errors->has('valor') ? 'is-invalid' : '' }}" placeholder="Valor" title="Valor" value="{{ old('valor', $gasto->valor ?? '') }}">
    <span class="text-danger">{{ $errors->first('valor') }}</span>
</div>
<div class="mb-3">
    <input class="btn btn-dark" type="submit" value="Guardar">
</div>