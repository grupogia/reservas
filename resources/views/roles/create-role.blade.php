@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="card p-3 mt-3 col-md-5">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
    
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input class="form-control" type="text" name="slug" value="{{ old('slug') }}">
                </div>
    
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                </div>
    
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input class="form-control" type="text" name="description" value="{{ old('description') }}">
                </div>
    
                <button class="btn btn-success" type="submit">Confirmar</button>
                <a class="btn btn-secondary" href="{{ route('roles') }}">Cancelar</a>
            </form>
        </div>
    
        {{-- <div class="card col-md-6 p-3 mt-3">
            <h4>Permisos</h4>

            <table class="table table-striped text-center border-bottom">
                <thead>
                    <th>Slug</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="p-1"><button class="btn btn-success">Agregar</button></th>
                </thead>

                <tbody>
                    @forelse ($role->permissions as $permission)
                        <tr>
                            <td>{{ $role->slug }}</td>
                            <td>{{ $role->slug }}</td>
                            <td>{{ $role->slug }}</td>
                            <td><button class="btn btn-danger">Quitar</button></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ 'No tiene permisos' }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> --}}
    </div>
</div>
@endsection