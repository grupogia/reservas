<div id="modalRegistrar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registrarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrarLabel">Reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @include('reservaciones.submodal-cargar')

                <form id="formReserva" action="#" method="post" autocomplete="off" data-url="{{ url('reservaciones') }}">
                    @csrf

                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingOne">
                                <button class="btn text-light w-100" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Datos del Cliente
                                </button>
                            </div>
                        
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    @include('reservaciones.datos-cliente')
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingTwo">
                                <button class="btn w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Datos de Reservación
                                </button>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    @include('reservaciones.datos-reservacion') 
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingThree">
                                <button class="btn w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Datos de Pago
                                </button>
                            </div>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    @include('reservaciones.datos-pago') 
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark p-1" id="headingFour">
                                <button class="btn w-100 text-light collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Datos de Segmentación
                                </button>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                <div class="card-body">
                                    @include('reservaciones.datos-segmentacion') 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-3">
                        <button type="submit" class="btn btn-success"><i class="fas fa-share"></i> Procesar</button>
                        <button type="button" class="btn btn-primary calculate"><i class="fas fa-search-dollar"></i> Calcular precio</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>