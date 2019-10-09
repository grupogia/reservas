@extends('layouts.app')

@section('content')

<div class="container">
    <div class="d-flex justify-content-around">
        <form class="card mt-3 p-4 col-md-5" action="{{ route('users.store') }}" method="post">
            @csrf
    
            <div class="form-group">
                <label for="name">Nombre completo</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
    
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="@">
    
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="*****">
    
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="*****">
    
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="w-100 p-0 m-0">
                <button class="btn btn-success col-5 col-md-3" type="submit">Confirmar</button>
                <a class="btn btn-secondary col-5 col-md-3 ml-2" href="{{ route('users') }}">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection