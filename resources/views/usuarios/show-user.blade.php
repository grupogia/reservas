@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-3 mt-3">
        <h1>Detalle de usuario</h1>

        <hr>
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