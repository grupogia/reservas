<div class="form-row">
    <div class="col-3">
        <div class="form-group">
            <label for="tipo_pago">Forma de Pago</label>
            <select class="form-control" name="tipo_pago" disabled>
                <option value="">- Elegir -</option>
                <option value="tarjeta">Tarjeta</option>
                <option value="efectivo">Efectivo</option>
                <option value="deposito">Depósito</option>
            </select>
            <input type="hidden" name="tipo_pago">
        </div>
    </div>
    
    <div class="tarjeta-selected tipo-pago" style="display: block">     
        <div class="form-row">
            <div class="col-12" data-name="no_tarjeta_cont">
                <label for="numero_tarjeta">Terminación</label>
                <span class="form-control" data-name="no_tarjeta" disabled></span>
            </div>
        </div>

        <div class="form-row align-items-center">
            <div class="col-12" data-name="no_tarjeta_cont">
                <label for="">Extra</label>
                <a id="btnChangePayment" class="btn btn-link d-block" href="" data-url="{{ url('cambiar-metodo-pago/') }}">Cambiar forma de pago</a>
            </div>
        </div>
    </div>

    <div class="efectivo-selected deposito-selected tipo-pago" style="display: none">
        <label for="monto">Monto</label>
        <input class="form-control" type="text" name="monto" placeholder="$ 0.00">
    </div>
</div>