@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card p-3 mt-3">
        <h1>Mis Reservaciones</h1>
        <hr>
    
        <ul>
            @forelse (auth()->user()->reservations as $reservation)
                <li>{{ $reservation->title }} | {{ $reservation->start }}</li>
            @empty
                <li>No has creado ninguna reservation</li>
            @endforelse
        </ul>        
    </div>
</div>
@endsection