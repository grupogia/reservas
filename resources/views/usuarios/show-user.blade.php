@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-3 mt-3">
        <h1>Usuario {{ $user->name }}</h1>

        <hr>

        <h3>Reservaciones</h3>
        <ul>            
            @forelse ($reservations as $reservation)
                <li>{{ $reservation->title }} {{ $reservation->start }}</li>
            @empty
                <div class="alert alert-warning m-0">Este usuario no ha creado ninguna reservación</div>
            @endforelse
        </ul>
    </div>
</div>
@endsection