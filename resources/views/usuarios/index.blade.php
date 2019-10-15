@extends('layouts.app')

@section('content')
<div class="container">
    @include('usuarios.modal-user')
    
    <div class="card mt-4 shadow">
        <div class="card-header">Usuarios</div>
        
        <div class="card-body">
            @include('alerts.show-errors')
            
            <table id="table_users" class="table table-striped text-center border-bottom">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Roles</th>
                        <th>Permisos</th>
                        <th>Especiales</th>
                        <th class="py-1">
                            {{-- <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i></a> --}}
                            <a class="btn btn-success py-1" data-toggle="modal" data-target="#modalUsuario"><i class="fas fa-plus-circle"></i></a>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{ route('users.show', ['user' => $user->id]) }}">{{ $user->id }}</a></td>
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
                            <td class="py-1">
                                <a class="btn btn-warning" href="{{ route('users.edit', [ 'user' => $user->id ]) }}"><i class="fas fa-edit"></i></a>
                            </td>
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

@push('scripts')
    <script>
        addEventListener('DOMContentLoaded', () => {
            let modalEl = $('#modalUsuario');

            modalEl.on('hidden.bs.modal', function (e) {
                modalEl[0].querySelector('form').reset();
            })
        })
    </script>
@endpush