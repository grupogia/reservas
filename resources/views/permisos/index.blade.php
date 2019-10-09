@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card p-3 mt-3">
        <h1>Permisos</h1>

        <table class="table table-striped border-bottom text-center mt-2">
            <thead class="thead-dark">
                <tr>
                    <th>Slug</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th class="p-1"><a class="btn btn-success" href="{{ route('permissions.create') }}">Crear</a></th>
                </tr>
            </thead>

            <tbody>
                @forelse ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->slug }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <form action="{{ route('permissions.destroy', [ 'permission' => $permission->id ]) }}" method="post">
                                @csrf @method('delete')
                                <button class="btn btn-danger" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection