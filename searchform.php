<form role="search" method="get" class="search-form form-a" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="row">
        <input type="hidden" name="post_type" value="inmueble" />
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label for="tipo_operacion"><?php echo esc_html_x('Tipo de operación:', 'label', 'chipicasa') ?></label>
                <select name="tipo_operacion" id="tipo_operacion" class="form-control form-control-lg form-control-a">
                    <option value=""><?php echo esc_html_x('Tipo de operación', 'placeholder', 'chipicasa') ?></option>
                    <option value="venta"><?php echo esc_html_x('Venta', 'option', 'chipicasa') ?></option>    
                    <option value="alquiler"><?php echo esc_html_x('Alquiler', 'option', 'chipicasa') ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-12 mb-2">
            <div class="form-group">
                <label for="tipo_inmueble"><?php echo esc_html_x('Todos los inmuebles:', 'label', 'chipicasa') ?></label>
                <select name="tipo_inmueble" id="tipo_inmueble" class="form-control form-control-lg form-control-a">
                    <option value=""><?php echo esc_html_x('Todos los inmuebles', 'placeholder', 'chipicasa') ?></option>
                    <?php
                        global $tipos_inmueble_map;
                        foreach ($tipos_inmueble_map as $slug => $name) {
                            echo '<option value="' . esc_attr($slug) . '">' . esc_html($name) . '</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-b search-submit"><?php echo esc_html__('Search Property', 'chipicasa') ?></button>
        </div>
    </div>
</form>
