<?php get_header(); ?>
<?php 


    // Definir un array asociativo para mapear valores de los tipos de inmueble
    global $tipos_inmueble_map;
    global $zonas_inmueble_map;

    $tipo_inmueble = get_post_meta(get_the_ID(), 'tipo_inmueble', true);
    $zona_inmueble = get_post_meta(get_the_ID(), 'zona_inmueble', true);
    $campos = obtener_campos_inmueble($post->ID);
    
    //mapa
    $coordenadas = get_post_meta(get_the_ID(), 'campo_mapa', true);
    if ($coordenadas) {
        $coordenadas = explode(',', $coordenadas);
        $lat = $coordenadas[0];
        $lng = $coordenadas[1];
    } else {
        // Proporciona un valor predeterminado si las coordenadas no están disponibles
        $lat = 0;
        $lng = 0;
    }

    $visibilidad_direccion = get_post_meta(get_the_ID(), 'visibilidad_direccion', true);


    // Pasa las coordenadas y la forma de mostrar el mapa de PHP a JavaScript
    wp_enqueue_script('scripts', get_template_directory_uri() . '/inc/scripts.js', array('jquery'), false, true);
    $datos_mapa = array(
        'lat' => $lat,
        'lng' => $lng,
        'visibilidad_direccion' => $visibilidad_direccion
    );
    wp_localize_script('scripts', 'datos_mapa', $datos_mapa);

    // Encolar el script de Google Maps
    $api_key = get_option('inmuebles_google_maps_api_key', '');
    wp_enqueue_script('google-maps', "https://maps.googleapis.com/maps/api/js?key={$api_key}&callback=initMap", array('scripts'), null, true);

?>

<style>

  .type-inmueble .inmueble-gallery .swiper {
    width: 100%;
    height: 100%;
    margin-bottom: 0;
    border-radius: 1% 1% 0 0;
  }
  
  .inmueble-details h4{
    align-self: flex-start;
  }
</style>

<main id="main" class="columns large-9 small-12">
    <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ) : the_post() ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Galería de imágenes -->
            <div class="inmueble-gallery">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($campos['galeria_imagenes'] ?? '' as $imagen) : ?>   
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($imagen); ?>" alt="Imagen">
                            </div>
                            <?php endforeach; ?>
                    </div>
                    <!-- Agrega botones de navegación -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="inmueble-details">
                <!-- Título -->
                <h4><?php echo $tipos_inmueble_map[$tipo_inmueble] . ' en ' . $campos['nombre_calle'] . ', ' . $campos['localidad'] ?></h4>
                <!-- Contenido del inmueble -->
                <div class="inmueble-content"> 
                    <!-- Precio -->
                    <p class="inmueble-price">
                        <?php if ($campos['precio_venta'] ?? '') : ?>
                            <?php echo $campos['precio_venta'] ?? ''; ?> €
                        <?php else: ?>
                            <?php echo $campos['precio_alquiler'] ?? ''; ?> €/mes
                        <?php endif; ?>
                    </p>
                    <!-- Características -->
                    <div class="inmueble-features">
                        <?php if ($campos['num_dormitorios'] ?? '') : ?>
                            <span><?php echo $campos['num_dormitorios'] . ' hab.'; ?></span>
                        <?php endif; ?>
                        <?php if ($campos['m_construidos'] ?? '') : ?>
                            <span><?php echo $campos['m_construidos'] . ' m²'; ?></span>
                        <?php endif; ?>
                    </div>
                    <!-- Descripción -->
                    <?php if ($campos['descripcion'] ?? '') : ?>
                        <div class="inmueble-description">
                            <p>Zona: <?php echo $zonas_inmueble_map[$zona_inmueble] ?? ''; ?></p>
                            <p><?php echo $campos['descripcion'] ?? ''; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="column-list-container">
                    <!-- Primera columna -->
                    <div class="column-list">
                        
                        <h4>Características básicas</h4>
                        <ul>
                            <?php
                            if (!empty($campos['planta'])) {
                                echo '<li>Planta: ' . esc_html($campos['planta']) . '</li>';
                            }

                            if (!empty($campos['bloque'])) {
                                echo '<li>Bloque: ' . esc_html($campos['bloque']) . '</li>';
                            }

                            if (!empty($campos['escalera'])) {
                                echo '<li>Escalera: ' . esc_html($campos['escalera']) . '</li>';
                            }

                            if (!empty($campos['urbanizacion'])) {
                                echo '<li>Urbanización: ' . esc_html($campos['urbanizacion']) . '</li>';
                            }

                            if (!empty($campos['interior_ext'])) {
                                echo '<li>Ubicación: ' . esc_html($campos['interior_ext']) . '</li>';
                            }

                            echo (!empty($campos['ascensor'] && $campos['ascensor'] === 'si')) ? '<li>Tiene ascensor</li>' : '<li>No tiene ascensor</li>';

                            if (!empty($campos['ac'])) {
                                echo '<li>Aire Acondicionado: ';
                                switch ($campos['ac']) {
                                    case 'no':
                                        echo 'No tiene';
                                        break;
                                    case 'frio':
                                        echo 'Frío';
                                        break;
                                    case 'frio_calor':
                                        echo 'Frío & Calor';
                                        break;
                                    case 'preinst':
                                        echo 'Preinstalado';
                                        break;
                                }
                                echo '</li>';
                            }

                            if (!empty($campos['tipologia_c'])) {
                                echo '<li>Planta: ' . esc_html($campos['planta']) . '</li>';
                            }

                            if (!empty($campos['tipologia_chalet'])) {
                                echo '<li>Tipo de Chalet: ';
                                echo ($campos['tipologia_chalet'] == 'atico') ? 'Ático' : (($campos['tipologia_chalet'] == 'estudio') ? 'Estudio' : (($campos['tipologia_chalet'] == 'duplex') ? 'Dúplex' : $campos['tipologia_chalet']));
                                echo '</li>';
                            }
                            

                            if (!empty($campos['tipo_local'])) {
                                echo '<li>Tipo de local: ';
                                echo ($campos['tipo_local'] == 'finca') ? 'Finca' : (($campos['tipo_local'] == 'castillo') ? 'Castillo' : (($campos['tipo_local'] == 'casa_rural') ? 'Casa Rural' : (($campos['tipo_local'] == 'casa_pueblo') ? 'Casa de Pueblo' : (($campos['tipo_local'] == 'cortijo') ? 'Cortijo' : $campos['tipo_local']))));
                                echo '</li>';
                            }
                           
                            if (!empty($campos['tipo_local'])) {
                                echo '<li>Tipo de casa rústica: ';
                                echo ($campos['tipo_rustica'] == 'finca') ? 'Finca' : (($campos['tipo_rustica'] == 'castillo') ? 'Castillo' : (($campos['tipo_rustica'] == 'casa_rural') ? 'Casa Rural' : (($campos['tipo_rustica'] == 'casa_pueblo') ? 'Casa de Pueblo' : (($campos['tipo_rustica'] == 'cortijo') ? 'Cortijo' : $campos['tipo_rustica']))));
                                echo '</li>';
                            }
                            
                            if (!empty($campos['tipo_terreno'])) {
                                echo '<li>Tipo de terreno: ';
                                echo ($campos['tipo_terreno'] == 'no_urbanizable') ? 'No urbanizable' : (($campos['tipo_terreno'] == 'urbanizable') ? 'Urbanizable' : (($campos['tipo_terreno'] == 'urbano') ? 'Urbano (solar)' : $campos['tipo_terreno']));
                                echo '</li>';
                            }

                            if (!empty($campos['tipo_plaza'])) {
                                echo '<li>Tipo de plaza: ';
                                echo ($campos['tipo_plaza'] == 'coche_peq') ? 'Coche pequeño' : (($campos['tipo_plaza'] == 'coche_grande') ? 'Coche grande' : (($campos['tipo_plaza'] == 'moto') ? 'Coche + Moto' : (($campos['tipo_plaza'] == 'coche_moto') ? 'Coche + Moto' : (($campos['tipo_plaza'] == 'mas_coches') ? '2 coches o más' : $campos['tipo_plaza']))));
                                echo '</li>';
                            }

                            if (!empty($campos['m_plaza'])) {
                                echo '<li>Superficie de la plaza: ' . esc_html($campos['m_plaza']) . '</li>';
                            }

                            if (!empty($campos['m_parcela'])) {
                                echo '<li>Metros de parcela: ' . esc_html($campos['m_parcela']) . '</li>';
                            }
                            
                            if (!empty($campos['m_fachada'])) {
                                echo '<li>Metros de fachada: ' . esc_html($campos['m_fachada']) . '</li>';
                            }

                            if (!empty($campos['m_lineales'])) {
                                echo '<li>Metros lineales: ' . esc_html($campos['m_lineales']) . '</li>';
                            }

                            if (!empty($campos['superf_terreno'])) {
                                echo '<li>Superficie del terreno: ' . esc_html($campos['superf_terreno']) . '</li>';
                            }

                            if (!empty($campos['num_estancias'])) {
                                echo '<li>Nº de estancias: ' . esc_html($campos['num_estancias']) . '</li>';
                            }

                            if (!empty($campos['num_plantas'])) {
                                echo '<li>Nº de plantas: ' . esc_html($campos['num_plantas']) . '</li>';
                            }

                            if (!empty($campos['num_escap'])) {
                                echo '<li>Nº de escaparates: ' . esc_html($campos['num_escap']) . '</li>';
                            }

                            if (!empty($campos['num_ascensores'])) {
                                echo '<li>Nº de ascensores: ' . esc_html($campos['num_ascensores']) . '</li>';
                            }

                            if (!empty($campos['num_plazas'])) {
                                echo '<li>Nº de plazas de garaje: ' . esc_html($campos['num_plazas']) . '</li>';
                            }

                            echo (!empty($campos['acceso_rodado'] && $campos['acceso_rodado'] === 'si')) ? '<li>Sí tiene</li>' : '<li>No disponible</li>';
                            
                            if (!empty($campos['si_rodado'])) {
                                echo '<li>Tipo de acceso: ';
                                echo ($campos['si_rodado'] == 'no') ? 'Sin definir' : (($campos['si_rodado'] == 'urbana') ? 'Vía urbana' : (($campos['si_rodado'] == 'carretera') ? 'Por carretera' : (($campos['si_rodado'] == 'tierra') ? 'Camino de tierra' : (($campos['si_rodado'] == 'autovia') ? 'Por autovía' : $campos['si_rodado']))));
                                echo '</li>';
                            }
                            
                            echo (!empty($campos['estado_cons'] && $campos['estado_cons'] === 'buen_estado')) ? '<li>En buen estado</li>' : '<li>A reformar</li>';
                            
                            echo (!empty($campos['uso_excl'] && $campos['uso_excl'] === 'si')) ? '<li>Uso exclusivo</li>' : '<li>Sin uso exclusivo</li>';
                            
                            if (!empty($campos['ubicacion_local'])) {
                                echo '<li>Ubicación del local: ';
                                echo ($campos['ubicacion_local'] == 'pie_calle') ? 'A pie de calle' : (($campos['ubicacion_local'] == 'centro_com') ? 'Centro comercial' : (($campos['ubicacion_local'] == 'entreplanta') ? 'Entreplanta' : (($campos['ubicacion_local'] == 'subterraneo') ? 'Subterránero' : $campos['ubicacion_local'])));
                                echo '</li>';
                            }
                            
                            if (!empty($campos['distribucion_oficina'])) {
                                echo '<li>Distribución de la oficina: ';
                                echo ($campos['distribucion_oficina'] == 'diafana') ? 'Diáfana' : (($campos['distribucion_oficina'] == 'mamparas') ? 'Dividida con mamparas' : (($campos['distribucion_oficina'] == 'tabiques') ? 'Dividida con tabiques' : $campos['distribucion_oficina']));
                                echo '</li>';
                            }
                            
                            if (!empty($campos['aire_acond'])) {
                                echo '<li>Aire acondicionado: ';
                                echo ($campos['aire_acond'] == 'no_disponible') ? 'No disponible' : (($campos['aire_acond'] == 'frio') ? 'Frío' : (($campos['aire_acond'] == 'frio_calor') ? 'Frío/calor' : (($campos['aire_acond'] == 'preinstalado') ? 'Preinstalación' : $campos['aire_acond'])));
                                echo '</li>';
                            }
                            
                            if (!empty($campos['calefaccion'])) {
                                echo '<li>Tipo de calefacción: ';
                                echo ($campos['calefaccion'] == 'individual') ? 'Individual' : (($campos['calefaccion'] == 'centralizada') ? 'Centralizada' : (($campos['calefaccion'] == 'no_dispone') ? 'No dispone' : $campos['calefaccion']));
                                echo '</li>';
                            }
                            ?> 
                        </ul>

                        <h4>Otras características:</h4>
                        <ul>
                            <?php 
                                if (!empty( $campos['otra_caract_inm'] )){
                                foreach ( $campos['otra_caract_inm'] as $caracteristica ) {
                                    echo '<li>' . esc_html( $caracteristica ) . '</li>';
                                }
                                if (!empty($campos['gastos_comunidad'])) {
                                    echo '<li>Gastos de comunidad: ';
                                    echo '<li>' . esc_html( $campos['gastos_comunidad'] ) . '</li>';
                                    echo '</li>';
                                }  
                                if (!empty($campos['fianza'])) {
                                    echo '<li>Fianza: ';
                                    echo '<li>' . esc_html( $campos['fianza'] ) . '</li>';
                                    echo '</li>';
                                }  
                                if (!empty($campos['ano_edificio'])) {
                                    echo '<li>Año del edificio: ';
                                    echo '<li>' . esc_html( $campos['ano_edificio'] ) . '</li>';
                                    echo '</li>';
                                }  
                            }
                            ?>   
                        </ul>
                        
                    </div>

                    <!-- Segunda columna -->
                    <div class="column-list">
                        <h4>Equipamiento</h4>
                        <ul>
                            <li>Tipo de inmueble</li>
                            <?php echo ( !empty( $campos['m_construidos'] )) ? '<li>' . esc_html( $campos['m_construidos']) . ' m² construidos</li>' : ''; ?>
                            <?php echo ( !empty( $campos['m_utiles'] )) ? '<li>' . esc_html( $campos['m_utiles']) . ' m² útiles</li>' : ''; ?>
                            <?php echo ( !empty( $campos['num_hab'] )) ? '<li>' . esc_html( $campos['num_hab']) . ' habitaciones</li>' : ''; ?>
                            <?php echo ( !empty( $campos['num_banos'] )) ? '<li>' . esc_html( $campos['num_banos']) . ' baños</li>' : ''; ?>
                            <?php echo ( !empty( $campos['superf_terreno'] )) ? '<li>Parcela de ' . esc_html( $campos['superf_terreno']) . ' m²</li>' : ''; ?>
                            <!-- Recorrer y mostrar cada característica del array $caract_inm -->
                            <?php 
                            foreach ( $campos['caract_inm'] as $caracteristica ) {
                                echo (!empty( $caracteristica )) ? '<li>' . esc_html( $caracteristica ) . '</li>' : '';
                            }  
                            ?>
                            

                        </ul>
                        <h4>Certificado energético</h4>
                        <ul>
                            <?php
                            //Consumo
                            if ( !empty( $campos['calif_consumo'] ) ) {
                                echo '<li>Consumo: <strong>' . esc_html( $campos['calif_consumo'] ) . '</strong>';
                                if ( !empty( $campos['consumo'] ) ) {
                                    echo esc_html( $campos['consumo'] )  . 'kWh/m² año';
                                }
                                echo '</li>';
                            }
                            ?>
                        </ul>
                        <h4>Emisiones</h4>
                        <ul>
                            <?php
                            //Emisiones
                            if ( !empty( $campos['calif_emis'] ) ) {
                                echo '<li>: <strong>' . esc_html( $campos['calif_emis'] ) . '</strong>';
                                if ( !empty( $campos['emisiones'] ) ) {
                                    echo ' ' . esc_html( $campos['emisiones'] )  . 'kg CO / m2 año';
                                }
                                echo '</li>';
                            }
                            ?>
                            </ul>
                            <?php 
                            if ( !empty( $campos['calif_consumo'] )){
                                echo '<h4>Orientación:</h4>';
                                foreach ( $campos['orientacion'] as $orientacion ) {
                                    echo '<li>' . esc_html( $orientacion ) . '</li>';
                                }
                            }
                            
                            if (!empty( $campos['calificacion_terreno'] )){
                                foreach ( $campos['calificacion_terreno'] as $tipo ) {
                                        echo '<li>' . esc_html( $tipo ) . '</li>';             
                                }
                            }
                            
                            if(!empty( $campos['caract_local'] )){
                                echo '<h4>Equipamiento del local:</h4>';
                                foreach ( $campos['caract_local'] as $carac_local ) {
                                    echo '<li>' . esc_html( $carac_local ) . '</li>';
                                }  
                            }
                            if(!empty( $campos['caract_local'] )){
                                echo '<h4>Características del garaje</h4>';
                                foreach ( $campos['caract_garaje'] as $caracteristica_garaje ) {
                                    echo '<li>' . esc_html( $caracteristica_garaje ) . '</li>';
                                }
                            }





                        ?>

                    </div>
                </div>
                <!-- mapa -->
                <h4>Mapa</h4>
                <div id="map" style="height: 400px; width: 100%; margin-bottom: 5%;"></div>
                <!-- plano -->
                <?php 
                
                $planos = array(
                    get_post_meta(get_the_ID(), 'plano1', true),
                    get_post_meta(get_the_ID(), 'plano2', true),
                    get_post_meta(get_the_ID(), 'plano3', true),
                    get_post_meta(get_the_ID(), 'plano4', true)
                );

                // Filtrar el array para eliminar valores vacíos o nulos
                $planos = array_filter($planos);

                if (!empty($planos)) : ?>
                    <h4>Planos</h4>
                    <?php foreach ($planos as $plano) : ?>
                        <img src="<?php echo esc_url($plano); ?>" alt="Plano del inmueble" style="width: 100%;">
                    <?php endforeach; ?>
                <?php endif; ?>


                
            </div>
            



              

                
           
                

        </article>
        <?php endwhile; ?>
    <?php else: ?>
        <?php get_template_part( 'template-parts/no-content' ); ?>
    <?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<script>
    /* Initialize Swiper */
    var swiper = new Swiper(".mySwiper", {
        cssMode: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
        mousewheel: true,
        keyboard: true,
    }); 

    /* sticky sidebar */
    var sidebar = $('.sticky-sidebar');
    if (sidebar.length > 0) {
        var sidebarOffset = sidebar.offset().top;

        $(window).scroll(function() {
            var scrollPos = $(window).scrollTop();

            if (scrollPos >= sidebarOffset) {
                sidebar.addClass('sticky');
            } else {
                sidebar.removeClass('sticky');
            }
        });
    }

    
</script>