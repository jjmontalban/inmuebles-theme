<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>

    <!-- Limita la busqueda a los inmuebles --> 
    <input type="hidden" name="post_type" value="inmueble" />


    <!-- Botones para filtrar por Tipo de Operación -->
    <label for="tipo_operacion_venta">
        <input type="radio" name="tipo_operacion" value="venta" id="tipo_operacion_venta">
        Venta
    </label>
    <label for="tipo_operacion_alquiler">
        <input type="radio" name="tipo_operacion" value="alquiler" id="tipo_operacion_alquiler">
        Alquiler
    </label>

    <!-- Agrega un select para filtrar por tipo de inmueble -->
    <select name="tipo_inmueble" id="tipo_inmueble">
        <option value="">Todos los inmuebles</option>
        <?php
        // Obtén la lista de términos de la taxonomía 'tipo_inmueble'
        $terms = get_terms('tipo_inmueble');

        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
            }
        }
        ?>
    </select>

    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />

</form>