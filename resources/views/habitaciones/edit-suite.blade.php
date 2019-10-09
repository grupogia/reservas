@extends('layouts.app')

@section('title', 'Suites')

@section('content')

<div class="container">
    @include('habitaciones.assign-rate')

    <div class="d-flex justify-content-around">
        <form class="card mt-3 p-4 col-md-5" action="{{ route('suites.update', [ 'suite' => $suite->id ]) }}" method="post">
            @csrf @method('put')
    
            <div class="form-group">
                <label for="number">Numero de habitación</label>
                <input class="form-control @error('number') is-invalid @enderror" type="text" name="number" value="{{ $suite->number }}">
    
                @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="title">Tipo de Suite</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $suite->title }}">
    
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="bed_type">Tipo de cama</label>
                <input class="form-control @error('bed_type') is-invalid @enderror" type="text" name="bed_type" value="{{ $suite->bed_type }}">
    
                @error('bed_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="bed_number">Numero de camas</label>
                <input class="form-control @error('bed_number') is-invalid @enderror" type="text" name="bed_number" value="{{ $suite->bed_number }}">
    
                @error('bed_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="w-12">
                <button class="btn btn-warning col-5 col-md-3" type="submit">Actualizar</button>
                <a class="btn btn-secondary col-5 col-md-3 ml-2" href="{{ route('suites') }}">Cancelar</a>
            </div>
        </form>
    
        {{-- Formulario para eliminar --}}
        <div class="card col-md-6 p-4 mt-3">
            <h4>Tarifas</h4>

            <table class="table table-striped border-bottom text-center">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Precio</th>
                        <th class="p-1"><button class="btn btn-success" data-toggle="modal" data-target="#assignRateModal">Agregar</button></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($suite->rates as $rate)
                        <tr>
                            <td>{{ $rate->type }}</td>
                            <td>$ {{ number_format($rate->price, 2) }}</td>
                            <td class="p-1">
                                <form action="{{ route('remove.rate', ['rate' => $rate->id]) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="btn btn-danger" type="submit">Quitar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>

            <form action="{{ route('suites.destroy', [ 'suite' => $suite->id ]) }}" method="post">
                @csrf @method('delete')
    
                @if ($errors->delete->any())
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->delete->first('permission') }}
                    </div>
                @endif
    
                <div class="d-flex justify-content-between align-items-center">
                    <label for="">Eliminar habitación</label>
                    <button class="btn btn-danger" type="submit">Borrar habitación</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection