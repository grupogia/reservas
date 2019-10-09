@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 col-md-5 p-3">
        <form action="{{ route('permissions.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="slug">Slug</label>
                <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" id="">

                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="">
                
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" id="">

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-success" type="submit">Confirmar</button>
            <a class="btn btn-secondary" href="{{ route('permissions') }}">Cancelar</a>
        </form>
    </div>
</div>
@endsection