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

<div class="table-responsive text-center">
    <table class="table table-striped mt-2">
        <thead>
            <tr>
                <th>Habitación</th>
                <th>Tarifa</th>
                <th>Adultos</th>
                <th>Niños</th>
                <th>Tipo cama</th>
                <th>Precio</th>
                <th>Opción</th>
            </tr>
        </thead>
    
        <tbody id="tbody_editar_habitaciones_cargadas">
            {{-- habitaciones con js --}}
        </tbody>
    
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td><strong>TOTAL / NOCHE</strong></td>
                <td id="total_editar_carga" class="bg-success">$ 0.00</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>