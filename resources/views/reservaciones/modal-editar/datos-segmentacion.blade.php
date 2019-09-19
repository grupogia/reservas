<div class="form-row">
    <div class="col-6">
        <div class="form-group">
            <label for="tipo_reserva">Tipo de reserva</label>
            <select class="form-control" name="tipo_de_reserva" id="">
                <option value="">- Elegir -</option>
                <option value="individual">Individual</option>
                <option value="grupal">Grupal</option>
            </select>
        </div>
    </div>

    <div class="individual-selected tipo-de-reserva col-12" style="display: none">
        <div class="form-row">
            <div class="col-6">
                <div class="form-group">
                    <label for="directas">Directas</label>
                    <select class="form-control" name="directas" id="">
                        <option value="">- Elegir -</option>
                        <option value="telefono">Telefono</option>
                        <option value="correo">Correo</option>
                        <option value="redes_sociales">Redes Sociales</option>
                        <option value="pagina_web">Pagina Web</option>
                        {{-- <option value="">Telvisión</option> --}}
                        <option value="gds">GDS</option>
                        <option value="expedia">Expedia</option>
                        <option value="bodas.com">bodas.com</option>
                        <option value="bestday">Best Day</option>
                        <option value="price_travel">Price Travel</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="grupal-selected tipo-de-reserva col-12" style="display: none">
        <div class="form-row">
            <div class="col-6">
                <div class="form-group">
                    <label for="sociales">Tipo</label>
                    <select class="form-control" name="sociales" id="">
                        <option value="">- Elegir -</option>
                        <option value="boda">Boda</option>
                        <option value="bautizo">Bautizo</option>
                        <option value="xv_anios">XV Años</option>
                        <option value="empresarial">Empresarial</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <label for="notas">Notas adicionales</label>
            <textarea class="form-control" name="notas"></textarea>
        </div>
    </div>
</div>