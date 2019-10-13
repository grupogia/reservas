@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 p-3 col-md-5">
        <h1>Editar detalle</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('reservation.detail.update', ['detail' => $detail->id]) }}" method="post" autocomplete="off">
            @csrf @method('put')

            <div class="form-group">
                <label for="">Habitación</label>
                <select class="form-control" name="habitacion" id="">
                    <option value="">- Elegir -</option>                        
                    @foreach ($suites as $suite)
                        <option value="{{ $suite->id }}" @if($suite->id == $detail->suite->id) selected @endif>{{ $suite->number . ' ' . $suite->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Tarifa</label>
                <select class="form-control" name="tarifa" id="">
                    <option value="">- Elegir -</option>
                    @foreach ($rates as $rate)
                        <option value="{{ $rate['type'] }}" @if($rate['type'] == strtolower($detail->rate_type)) selected @endif>{{ $rate['type'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Adultos</label>
                <input type="number" min="1" name="adultos" id="" class="form-control" value="{{ $detail->adults }}">
            </div>

            <div class="form-group">
                <label for="">Niños</label>
                <input type="number" min="0" name="ninios" id="" class="form-control" value="{{ $detail->children }}">
            </div>

            <div class="form-group">
                <label for="">Precio (MXN)</label>
                <input type="text" name="precio" id="" class="form-control" value="$ {{ number_format($detail->subtotal, 2) }}" disabled>
            </div>

            <button class="btn btn-warning" type="submit">Actualizar</button>
            <a class="btn btn-secondary" href="{{ route('home') }}">Cancelar</a>
        </form>
    </div>
</div>
@endsection