<div class="form-row">
    <div class="col-6">
        <div class="form-group">
            <label for="tipo_reserva">Tipo de reserva</label>
            <select class="form-control" name="tipo_de_reserva" id="" disabled>
                <option value="">- Elegir -</option>
                <option value="individual">Individual</option>
                <option value="grupal">Grupal</option>
            </select>
        </div>
    </div>

    <div class="individual-selected tipo-de-reserva col-12" style="display: block">
        <div class="form-row">
            <div class="col-6">
                <div class="form-group">
                    <label for="canal">Canal</label>
                    <select class="form-control" name="canal" id="selectCanal" disabled>
                        <option class="canal empty directas otas" value="">- Elegir -</option>
                        <option class="canal directas" style="display: none" value="telefono">Telefono</option>
                        <option class="canal directas" style="display: none" value="correo">Correo</option>
                        <option class="canal directas" style="display: none" value="redes_sociales">Redes Sociales</option>
                        <option class="canal directas" style="display: none" value="pagina_web">Pagina Web</option>
                        {{-- <option value="">Telvisión</option> --}}
                        <option class="canal otas" style="display: none" value="gds">GDS</option>
                        <option class="canal otas" style="display: none" value="expedia">Expedia</option>
                        <option class="canal otas" style="display: none" value="booking">Booking</option>
                        <option class="canal otas" style="display: none" value="bestday">Best Day</option>
                        <option class="canal otas" style="display: none" value="price_travel">Price Travel</option>
                        <option value="boda">Boda</option>
                        <option value="bautizo">Bautizo</option>
                        <option value="xv_anios">XV Años</option>
                        <option value="empresarial">Empresarial</option>
                    </select>
                    <input type="hidden" name="canal">
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="grupal-selected tipo-de-reserva col-12" style="display: none">
        <div class="form-row">
            <div class="col-6">
                <div class="form-group">
                    <label for="sociales">Tipo</label>
                    <select class="form-control" name="sociales" id="">
                        <option value="">- Elegir -</option>
                        
                    </select>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-12">
        <div class="form-group">
            <label for="notas">Notas adicionales</label>
            <textarea class="form-control" name="notas"></textarea>
        </div>
    </div>
</div>