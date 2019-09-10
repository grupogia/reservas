<div class="form-row">
    <div class="col-6 form-group">
        <label for="entrada">Entrada (Check In)</label>
        
        <div class="form-row">
            <div class="col">
                <input class="form-control datepk" type="text" name="fecha_de_entrada">
            </div>

            <div class="col">
                <input class="form-control timepk" type="text" name="hora_de_entrada">
            </div>
        </div>
    </div>

    <div class="col-6 form-group">
        <label for="salida">Salida (Check Out)</label>
        
        <div class="form-row">
            <div class="col">
                <input class="form-control datepk" type="text" name="fecha_de_salida">
            </div>

            <div class="col">
                <input class="form-control timepk" type="text" name="hora_de_salida">
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="form-group">
            <label for="adultos">Adultos</label>
            <input class="form-control" type="text" name="adultos">
        </div>
    </div>

    <div class="col-3">
        <div class="form-group">
            <label for="ninos">Niños</label>
            <input class="form-control" type="text" name="ninos">
        </div>
    </div>
</div>

<a class="btn btn-primary float-right" href="#submodalHabitacion" data-toggle="submodal">Cargar habitación</a>

<div class="table-responsive">
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Habitación</th>
                <th>Tarifa</th>
                <th>Tipo cama</th>
                <th>Precio</th>
            </tr>
        </thead>
    
        <tbody id="tbody_habitaciones_cargadas">
            <tr>
                <td>Villa</td>
                <td>Bar 1</td>
                <td>King / Queen</td>
                <td>$ 4,469</td>
            </tr>
        </tbody>
    
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td><strong>TOTAL</strong></td>
                <td id="total_carga" class="bg-success">$ 4,469</td>
            </tr>
        </tfoot>
    </table>
</div>