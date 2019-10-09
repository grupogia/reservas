@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-3 col-md-5 mt-3">
        <h1>Perfil</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="post">
            @csrf @method('put')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="" value="{{ auth()->user()->name }}">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="" value="{{ auth()->user()->email }}" placeholder="@">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Nueva contraseña</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="" placeholder="*****">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="" placeholder="*****">

                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button class="btn btn-warning" type="submit">Actualizar</button>
        </form>
    </div>
</div>
@endsection