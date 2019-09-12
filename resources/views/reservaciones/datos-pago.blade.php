<div class="form-row">
    <div class="col-3">
        <div class="form-group">
            <label for="tipo_pago">Forma de Pago</label>
            <select class="form-control" name="tipo_pago">
                <option value="">- Elegir -</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="efectivo">Efectivo</option>
                <option value="deposito">Depósito</option>
            </select>                                
        </div>
    </div>

    <div class="tarjeta-selected tipo-pago" style="display: none">
        <div class="form-row">
            <div class="col-3">
                <div class="form-group">
                    <label for="n_tarjeta">Num. Tarjeta</label>
                    <input class="form-control" type="text" name="n_tarjeta">
                </div>
            </div>
        
            <div class="col-3">
                <label for="form-group">Vencimiento</label>
                <input class="form-control" type="text" name="vencimiento">
            </div>
        
            <div class="col-3">
                <label for="form-group">Codigo seguridad</label>
                <input class="form-control" type="text" name="codigo_seguridad">
            </div>
        
            <div class="col-3">
                <label for="form-group">Titular</label>
                <input class="form-control" type="text" name="titular">
            </div>
        </div>
    </div>

    <div class="efectivo-selected tipo-pago"></div>

    <div class="deposito-selected tipo-pago"></div>
</div>