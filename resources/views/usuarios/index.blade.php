@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">Usuarios</div>

        <div class="card-body">
            <table id="table_users" class="table table-striped text-center border-bottom">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Roles</th>
                        <th>Permisos</th>
                        <th>Especiales</th>
                        <th class="py-1"><a class="btn btn-success" href="{{ route('users.create') }}">Crear</a></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                {{ $role->name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($user->permissions as $permission)
                                {{ $permission->name }}
                                @endforeach
                            </td>
                            <td>{{ $user->special }}</td>
                            <td class="py-1"><a class="btn btn-warning" href="{{ route('users.edit', [ 'user' => $user->id ]) }}">Cambiar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .table {
            font-size: 13px;
        }
        .table th {
            text-transform: uppercase;
        }
    </style>
@endpush