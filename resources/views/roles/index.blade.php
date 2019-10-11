@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 p-3">
        <h1>Roles</h1>
        <hr>

        <table class="table table-striped border-bottom text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Slug</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="p-1"><a class="btn btn-success" href="{{ route('roles.create') }}"><i class="fas fa-plus-circle"></i></a></th>
                </tr>
            </thead>

            <tbody>
                @forelse ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->slug }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td class="p-1"><a class="btn btn-warning" href="{{ route('roles.edit', [ 'role' => $role->id ]) }}"><i class="fas fa-edit"></i></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ 'No hay roles' }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
    <style>
        th {
            text-transform: uppercase;
        }
    </style>
@endpush