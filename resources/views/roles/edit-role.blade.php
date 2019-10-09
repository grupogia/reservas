@extends('layouts.app')

@section('content')
@include('roles.asignar-permisos')

<div class="container">
    <div class="row justify-content-between">
        <div class="card p-3 mt-3 col-md-5">
            <form action="{{ route('roles.update', [ 'role' => $role->id ]) }}" method="post">
                @csrf @method('put')
    
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input class="form-control" type="text" name="slug" value="{{ $role->slug }}">
                </div>
    
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" value="{{ $role->name }}">
                </div>
    
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input class="form-control" type="text" name="description" value="{{ $role->description }}">
                </div>
    
                <button class="btn btn-warning" type="submit">Cambiar</button>
                <a class="btn btn-secondary" href="{{ route('roles') }}">Cancelar</a>
            </form>
        </div>
    
        <div class="card col-md-6 p-3 mt-3">
            <h4>Permisos</h4>

            <table class="table table-striped text-center border-bottom">
                <thead>
                    <th>Slug</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="p-1"><button class="btn btn-success" data-toggle="modal" data-target="#permisosModal">Agregar</button></th>
                </thead>

                <tbody>
                    @forelse ($role->permissions as $permission)
                        <tr>
                            <td>{{ $permission->slug }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                            <td><button class="btn btn-danger">Quitar</button></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ 'No tiene permisos' }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection