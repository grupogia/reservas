@extends('layouts.app')

@section('content')
<div class="container">
    @include('habitaciones.modal-suite')

    <div class="card mt-3 p-4 shadow">
        <h1>Habitaciones</h1>

        @include('alerts.show-response')

        <div class="table-responsive p-2">
            <table id="tableSuites" class="table table-striped text-center table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Tipo</th>
                        <th>Camas</th>
                        <th>N. C.</th>
                        <th>Creación</th>
                        <th>Actualizado</th>
                        <th>
                            {{-- <a class="btn btn-success py-1" href="{{ route('suites.create') }}"><i class="fas fa-plus-circle"></i></a> --}}
                            <button class="btn btn-success py-1" type="button" data-toggle="modal" data-target="#modalSuite"><i class="fas fa-plus-circle"></i></button>
                        </th>
                    </tr>
                </thead>
    
                <tbody>
                    {{-- <tr>
                        <td>13</td>
                        <td>Bugambileas</td>
                        <td>3 Queen</td>
                        <td>21/21/2133</td>
                        <td>21/21/2133</td>
                        <td class="p-1"><button class="btn btn-secondary show-details">Detalles</button></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        addEventListener('DOMContentLoaded', () => {
            $('#modalSuite').on('hidden.bs.modal', function (e) {
                $('#formAddSuite')[0].reset();
            })
        })
    </script>
@endpush