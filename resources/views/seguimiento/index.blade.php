@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 p-4">
        <h1>Seguimiento</h1>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Descripción</th>
                    <th>Realizó</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>21/21/2133</td>
                    <td>13:42:21</td>
                    <td>Actividad</td>
                    <td>Juanito</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection