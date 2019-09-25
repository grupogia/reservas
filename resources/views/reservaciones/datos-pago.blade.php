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
                    <label for="numero_tarjeta">Num. Tarjeta</label>
                    <input class="form-control" type="text" name="numero_tarjeta">
                </div>
            </div>
        
            <div class="col-3">
                <label for="form-group">Vencimiento</label>
                <input class="form-control" type="text" name="vencimiento" placeholder="mm/yy">
            </div>
        
            <div class="col-3">
                <label for="form-group">Codigo seguridad</label>
                <input class="form-control" type="text" name="codigo_seguridad" placeholder="ccv">
            </div>
        
            <div class="col-3">
                <label for="form-group">Titular</label>
                <input class="form-control" type="text" name="titular">
            </div>
        </div>
    </div>

    <div class="efectivo-selected deposito-selected tipo-pago" style="display: none">
        <label for="monto">Monto</label>
        <input class="form-control" type="text" name="monto" placeholder="$ 0.00">
    </div>
</div>