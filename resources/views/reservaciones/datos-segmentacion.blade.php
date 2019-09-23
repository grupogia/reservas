<div class="form-row">
    <div class="col-6">
        <div class="form-group">
            <label for="tipo_de_segmentacion">Tipo de segmentacion</label>
            <select class="form-control" name="tipo_de_segmentacion" id="">
                <option value="">- Elegir -</option>
                <option value="individual">Individual</option>
                <option value="grupal">Grupal</option>
            </select>
        </div>
    </div>

    <div class="individual-selected tipo-de-segmentacion col-12" style="display: none">
        <div class="form-row">
            <div class="col-6">
                <div class="form-group">
                    <label for="tipo">Tipo</label>

                    <select class="form-control" name="tipo">
                        <option value="">- Elegir -</option>
                        <option value="directas">Directa</option>
                        <option value="otas">OTAs</option>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="canal">Canal</label>
                    <select class="form-control" name="canal" id="selectCanal">
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
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="grupal-selected tipo-de-segmentacion col-12" style="display: none">
        <div class="form-row">
            <div class="col-6">
                <div class="form-group">
                    <label for="canal_grupal">Canal</label>
                    <select class="form-control" name="canal_grupal">
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