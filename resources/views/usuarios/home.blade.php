@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            <button class="btn btn-primary float-right mb-3" data-toggle="modal" data-target="#modalRegistrar" type="button">Registrar</button>

            <div id="modalRegistrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registrarLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registrarLabel">Nueva reserva</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            ...
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-dark text-center">
                <thead>
                    <tr>
                        <th>fecha</th>
                        <th>total occ</th>
                        <th>vancantes</th>
                        <th>disponibles</th>
                        <th>% cc</th>
                        <th>ingresos hab</th>
                        <th>tarifa media</th>
                        <th>tipo de cama</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ date('d-m-Y') }}</td>
                        <td>2</td>
                        <td>13</td>
                        <td>15</td>
                        <td>13.33%</td>
                        <td>$ 2,759.28</td>
                        <td>$ 1,379.64</td>
                        <td class="pt-1 pb-1">
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#modalRegistrar" type="button">ver</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
    </style>
@endpush