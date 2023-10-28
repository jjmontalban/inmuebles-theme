<div class="search-container">
        <h2>Buscar inmueble</h2>
    <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
        <!-- Limita la búsqueda a los inmuebles --> 
        <input type="hidden" name="post_type" value="inmueble" />

        <!-- Agrega un select para filtrar por tipo de operación -->
        <select name="tipo_operacion" id="tipo_operacion">
            <option value="">Tipo de operación</option>
            <option value="venta">Venta</option>    
            <option value="alquiler">Alquiler</option>
        </select>

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

        <input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
    </form>
</div>
