@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('success'))
        <div class="alert alert-success mt-4" role="alert">
            <strong>Correcto.</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif

    <div class="d-flex justify-content-around">
        <form class="card mt-3 p-4 col-md-5" action="{{ route('users.update', [ 'user' => $user->id ]) }}" method="post">
            @csrf @method('put')
    
            <div class="form-group">
                <label for="name">Nombre completo</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $user->name }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ $user->email }}" placeholder="@">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña (Opcional)</label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="* * * * *">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="* * * * *">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    
            <div class="w-100 p-0 m-0">
                <button class="btn btn-warning col-5 col-md-3" type="submit">Actualizar</button>
                <a class="btn btn-secondary col-5 col-md-3 ml-2" href="{{ route('users') }}">Cancelar</a>
            </div>
        </form>
    
        {{-- Formulario para eliminar --}}
        <div class="card mt-3 p-4 col-md-6">
            @error('slug')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <h4 class="mt-2">Roles</h4>

            <table class="table text-center border-bottom">
                <thead>
                    <tr>
                        <th>Slug</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th class="p-1">
                            <button class="btn btn-success" data-toggle="modal" data-target="#rolesModal">Asignar</button>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($user->roles as $role)
                        <tr>
                            <td>{{ $role->slug }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td class="py-1">
                                <form action="{{ route('remove.role.user', [ 'user' => $user->id ]) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{ $role->slug }}">
                                    <button class="btn btn-danger" type="submit">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-warning">
                                    Este usuario no tiene roles
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <form class="col-md-10 m-auto" action="{{ route('users.destroy', [ 'user' => $user->id ]) }}" method="post">
                @csrf @method('delete')
    
                @if ($errors->delete->any())
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->delete->first('permission') }}
                    </div>
                @endif
    
                <div class="d-flex justify-content-between align-items-center">
                    <label for="">Eliminar usuario</label>
                    <button class="btn btn-danger" type="submit">Borrar usuario</button>
                </div>
            </form>
        </div>
    </div>
    
    @include('usuarios.asignar-role')
</div>
@endsection