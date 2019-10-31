<div id="submodalHabitacion" class="modal submodal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-body">
                <h5>Nueva habitacion</h5>

                <form id="formCargarHab" action="/">
                    <div class="form-group">
                        <label for="habitacion">Habitacion</label>
                        <select class="form-control" name="habitacion" id="habitacionesModalReservaciones" required>
                            <option value="">- Elegir -</option>
            
                            @foreach ($suites as $suite)
                                <option value="{{ $suite->id }}">{{ $suite->number . ' ' . $suite->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tarifa">Tarifa</label>
                        <select class="form-control" name="tarifa" required>
                            <option value="">- Elegir -</option>
                            <option value="rack">Rack</option>
                            <option value="bar 1">Bar 1</option>
                            <option value="bar 2">Bar 2</option>
                            <option value="grupal">Grupal</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="adultos">Adultos</label>
                                <input class="form-control" type="number" name="adultos" value="1">
                            </div>
                        </div>
                    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="ninos">Niños</label>
                                <input class="form-control" type="number" name="ninios" value="0">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success" type="submit">Cargar</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="submodal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>