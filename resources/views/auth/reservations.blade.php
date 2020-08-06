@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card my-3 pt-3">
        <h1 class="px-3 pb-1">Mis Reservaciones</h1>
        <table class="table mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Título</th>
                    <th>Fecha</th>
                    <th>Creación</th>
                    <th>Actualización</th>
                </tr>
            </thead>
            <tbody class="tbody">
                @forelse (auth()->user()->reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->title }}</td>
                        <td>{{ $reservation->start }}</td>
                        <td>{{ $reservation->created_at }}</td>
                        <td>{{ $reservation->updated_at }}</td>
                    </tr>
                @empty
                    <div class="alert alert-warning">No has creado ninguna reservation</div>
                @endforelse
            </tbody>
        </table>     
    </div>
</div>
@endsection