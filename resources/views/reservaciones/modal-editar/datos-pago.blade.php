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
    
    <div class="tarjeta-selected tipo-pago col-6" style="display: block">     
        <div class="form-row">
            <div class="col-4" data-name="no_tarjeta_cont">
                <label for="numero_tarjeta">Terminación</label>
                <span class="form-control" data-name="no_tarjeta" disabled></span>
            </div>

            <div class="col-8">
                <label for="">Extra</label>
                <a id="btnChangePayment" class="btn btn-link d-block" href="" data-url="{{ url('cambiar-metodo-pago/') }}"><i class="fas fa-exchange-alt"></i> Cambiar forma de pago</a>
            </div>
        </div>
    </div>

    <div class="efectivo-selected deposito-selected tipo-pago" style="display: none">
    </div>
</div>