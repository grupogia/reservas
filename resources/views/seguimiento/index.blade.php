@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card my-3 p-4 shadow">
        <h1>Seguimiento</h1>
        <table class="table mt-3 text-center">
            <thead class="thead-light">
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                    <th>Realizó</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ date('d-m-Y') }}</td>
                    <td>13:42:21</td>
                    <td>Actividad</td>
                    <td>Juanito</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection