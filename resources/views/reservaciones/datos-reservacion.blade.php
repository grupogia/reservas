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
</div>

<a id="btnVaciarReservas" class="btn btn-danger float-right" href="vaciar-carrito"><i class="fas fa-trash-alt"></i> Vaciar</a>
<a class="btn btn-primary float-right mr-1" href="#submodalHabitacion" data-toggle="submodal"><i class="far fa-calendar-plus"></i> Cargar habitación</a>

<div class="table-responsive text-center">
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Habitación</th>
                <th>Cant</th>
                <th>Adultos</th>
                <th>Niños</th>
                <th>Tarifa</th>
                <th>Tipo cama</th>
                <th>Precio</th>
            </tr>
        </thead>
    
        <tbody id="tbody_habitaciones_cargadas">
            {{-- habitaciones con js --}}
        </tbody>
    
        <tfoot>
            <tr>
                <td colspan="5"></td>
                <td><strong>TOTAL</strong></td>
                <td id="total_carga" class="bg-success">$ 0.00</td>
            </tr>
        </tfoot>
    </table>
</div>