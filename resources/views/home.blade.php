@extends('layouts.app')

@section('content')
<div class="container">
    @include('reservaciones.modal')
    @include('reservaciones.modal-editar')

    <div id="hotelCalendar"></div>
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