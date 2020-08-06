@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card my-3 shadow">
        <div class="card-header">
            <strong><i class="fas fa-tachometer-alt fa-lg mr-2"></i> DASHBOARD</strong>
        </div>
        <div class="card-body">
            <h3>Accesos</h3>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('users') }}"><i class="fas fa-users"></i> Usuarios</a></li>
                <li class="list-group-item"><a href="{{ route('roles') }}"><i class="fas fa-users-cog"></i> Roles</a></li>
                <li class="list-group-item"><a href="{{ route('permissions') }}"><i class="fas fa-address-card"></i> Permisos</a></li>
            </ul>
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