<div id="modalEditar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarLabel">Reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="formEditarReserva" action="#" method="post" autocomplete="off" data-url="{{ url('reservaciones') }}">
                    @csrf @method('PUT')

                    <div class="accordion" id="accordionEdit">
                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingEditClient">
                                <button class="btn text-light w-100" type="button" data-toggle="collapse" data-target="#collapseEditOne" aria-expanded="true" aria-controls="collapseEditOne">
                                    Datos del Cliente
                                </button>
                            </div>
                        
                            <div id="collapseEditOne" class="collapse show" aria-labelledby="headingEditClient" data-parent="#accordionEdit">
                                <div class="card-body">
                                    @include('reservaciones.modal-editar.datos-cliente')
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingEditReservation">
                                <button class="btn w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseEditTwo" aria-expanded="false" aria-controls="collapseEditTwo">
                                    Datos de Reservación
                                </button>
                            </div>
                            <div id="collapseEditTwo" class="collapse" aria-labelledby="headingEditReservation" data-parent="#accordionEdit">
                                <div class="card-body">
                                    @include('reservaciones.modal-editar.datos-reservacion') 
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingEditPay">
                                <button class="btn w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseEditPay" aria-expanded="false" aria-controls="collapseEditPay">
                                    Datos de Pago
                                </button>
                            </div>

                            <div id="collapseEditPay" class="collapse" aria-labelledby="headingEditPay" data-parent="#accordionEdit">
                                <div class="card-body">
                                    @include('reservaciones.modal-editar.datos-pago') 
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingFour">
                                <button class="btn w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Datos de Segmentación
                                </button>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionEdit">
                                <div class="card-body">
                                    @include('reservaciones.modal-editar.datos-segmentacion') 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3">
                        <button type="submit" class="btn btn-warning">Actualizar reservación</button>
                        <button id="btnDeleteReservacion" type="button" class="btn btn-danger">Eliminar reservación</button>
                        <input class="py-1 px-2" id="totalConImpuestos" type="text" disabled>
                        <a type="button" class="btn btn-warning" href="" data-url="{{ url('/imprimir-reservacion') }}" target="_black">
                            <i class="fas fa-print"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>