@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            <ul>
                <li>
                    <a href="{{ route('roles') }}">Roles</a>
                </li>

                <li>
                    <a href="{{ route('permissions') }}">Permisos</a>
                </li>
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