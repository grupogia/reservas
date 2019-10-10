@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-3 mt-3">
        <h1>Detalle de usuario</h1>

        <hr>
        <ul>
            @foreach ($reservations as $reservation)
                <li>{{ $reservation->title }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection