@extends('layouts.app')

@section('title', 'Suites')

@section('content')

<div class="container">
    <div class="d-flex justify-content-between">
        <form class="card mt-3 p-4 col-md-5" action="{{ route('suites.store') }}" method="post">
            @csrf
    
            <div class="form-group">
                <label for="number">Numero de habitación</label>
                <input class="form-control @error('number') is-invalid @enderror" type="text" name="number" value="{{ old('number') }}">
    
                @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="title">Tipo de Suite</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
    
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="bed_type">Tipo de cama</label>
                <input class="form-control @error('bed_type') is-invalid @enderror" type="text" name="bed_type" value="{{ old('bed_type') }}">
    
                @error('bed_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="bed_number">Numero de camas</label>
                <input class="form-control @error('bed_number') is-invalid @enderror" type="text" name="bed_number" value="{{ old('bed_number') }}">
    
                @error('bed_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="row col-12">
                <button class="btn btn-primary col-5 col-md-3" type="submit">Send</button>
                <button class="btn btn-secondary col-5 col-md-3 ml-2" type="button" onclick="history.back()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

@endsection