@extends('layouts.app')

@section('content')
<div class="container">
    @can('index.reservations')
        @include('reservaciones.modal')
        @include('reservaciones.modal-editar')

        <div id="hotelCalendar"></div>
    @else
        <div class="card p-3 mt-3 text-center">
            <h1>Sistema de reservaciones</h1>
            <h2>Jardín Meliar</h2>
        </div>
    @endcan
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

        #hotelCalendar {
            max-width: 1200px;
            margin: 40px auto;
        }
    </style>
@endpush