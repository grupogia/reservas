@extends('layouts.app')

@section('content')
    @can('index.reservations')
        @include('reservaciones.modal')
        @include('reservaciones.modal-editar')

        <div class="clalendar-container table-responsive p-3">
            <div id="hotelCalendar"></div>
        </div>
    @else
        <div class="card p-3 mt-3 text-center">
            <h1>Sistema de reservaciones</h1>
            <h2>Jardín Meliar</h2>
        </div>
    @endcan
@endsection

@push('styles')
    <style>
        .table {
            font-size: 13px;
        }

        .table th {
            text-transform: uppercase;
        }

        .calendar-container {
            overflow: auto;
        }

        #hotelCalendar {
            width: 95%;
            max-width: 2000px;
            min-width: 700px;
            margin: 40px auto;
        }
        .fc-event { color: #ffff !important }
    </style>
@endpush