<style>

    /* Contenedor principal */
.inmuebles-details {
    display: flex; /* Hacer que los hijos (galería y contenido) se muestren en filas (default) */
    gap: 20px; /* Espacio entre las columnas */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra ligera */
    transition: box-shadow 0.3s ease; /* Transición suave para el efecto hover */
    cursor: pointer; /* Cambia el cursor a mano cuando pasa por encima */
    border-radius: 0.25rem; /* Ajusta este valor según tus preferencias */
    overflow: hidden; /* Esto asegura que los contenidos internos no sobresalgan fuera del borde redondeado */
    
}

.inmuebles-gallery img {
    border-radius: 0.25rem 0 0 0.25rem; /* Esto redondeará solo las esquinas izquierdas de las imágenes */
}


/* Específicamente para los títulos, descripciones, etc., si quieres asignarles un color diferente */
.inmuebles-details p, .inmuebles-details span {
    color: #333; /* Cambia esto al color que prefieras, puse negro como ejemplo */
}

/* Efecto al pasar el cursor por encima */
.inmuebles-details:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Sombra más intensa */
}

/* Galería */
.inmuebles-gallery {
    flex: 1; /* Tomará la mitad del espacio disponible */
    max-width: 33.33%; /* Limitar al 50% del ancho del contenedor */
}

/* Contenido */
.inmuebles-content {
    flex: 1; /* Tomará la mitad del espacio disponible */
    max-width: 66.66%; /* Limitar al 50% del ancho del contenedor */
    padding: 10px; /* Espaciado interno para que el contenido no esté pegado a los bordes */
}

/* Título del inmueble */
.inmuebles-content h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

/* Precio */
.inmuebles-price {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

/* Características del inmueble (habitaciones, metros cuadrados) */
.inmuebles-features {
    display: flex;
    gap: 10px; /* Espacio entre elementos */
    margin-bottom: 10px;
}

/* Descripción */
.inmuebles-description p {
    margin-bottom: 10px;
}

/* Adaptable para dispositivos móviles */
@media (max-width: 768px) {
    .inmuebles-details {
        flex-direction: column; /* Cambiar a diseño de una sola columna para móviles */
    }
    .inmuebles-gallery, .inmuebles-content {
        max-width: 100%; /* En móviles, que ocupe todo el ancho disponible */
    }
}


/* Contenedor principal del inmueble */
.inmueble-details {
    display: flex;
    flex-direction: column; /* Se asegura que todos los elementos estén en una sola columna */
    align-items: center; /* Centra todo en la columna */


    gap: 20px; /* Espacio entre las columnas */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra ligera */
    transition: box-shadow 0.3s ease; /* Transición suave para el efecto hover */
    cursor: pointer; /* Cambia el cursor a mano cuando pasa por encima */
    border-radius: 0.25rem; /* Ajusta este valor según tus preferencias */
}

/* Galería */
/* Galería */
.inmueble-gallery {
    flex: 1; /* Tomará la mitad del espacio disponible */
    max-width: 100%; /* Limitar al 50% del ancho del contenedor */
}


.inmueble-gallery .swiper {
    width: 80%; /* Ajusta según tus necesidades */
    margin-bottom: 20px;
}

/* Título */
.inmueble-content h2 {
    font-size: 1.5em; /* Hace que el título sea más pequeño */
    margin-bottom: 20px;
}

/* Precio */
.inmueble-price {
    font-size: 2em; /* Hace que el precio sea más grande */
    margin-bottom: 20px;
}

/* Características */
.inmueble-features {
    display: flex;
    justify-content: space-between; /* Espacia los elementos */
    width: 80%; /* Ajusta según tus necesidades */
    margin-bottom: 20px;
}

/* Descripción */
.inmueble-description {
    margin-bottom: 20px;
}

/* Contenedor para las dos listas en la última fila */
.column-list-container {
    display: flex;
    justify-content: space-between;
    width: 80%; /* Ajusta según tus necesidades */
    margin-bottom: 20px;
}

/* Cada una de las listas */
.column-list {
    width: 45%; /* Ajusta según tus necesidades */
}

#content {
}

</style>


<?php 
    // Definir un array asociativo para mapear valores de los tipos de inmueble
    $tipo_inmueble = get_post_meta(get_the_ID(), 'tipo_inmueble', true);
    $tipos_inmueble_map = array(
        'piso' => 'Piso',
        'casa_rustica' => 'Casa rústica',
        'apartamento' => 'Apartamento',
        'casa_chalet' => 'Chalet',
        'local' => 'Local',
        'garaje' => 'Garaje',
        'oficina' => 'Oficina',
        'terreno' => 'Terreno',
    );

    $campos = obtener_campos_inmueble($post->ID);


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- Detalles de un inmueble -->
    <?php if (is_singular('inmueble')): ?>
        <!-- Título -->
        <div class="inmueble-details">
            <h2><?php echo $tipos_inmueble_map[$tipo_inmueble] . ' en ' . $campos['nombre_calle'] . ', ' . $campos['localidad'] ?></h2>
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
                        <p><?php echo $campos['descripcion'] ?? ''; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="column-list-container">
                <!-- Primera columna -->
                <div class="column-list">
                    
                    <h3>Características básicas</h3>
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
                            echo '<li>Tipo de casa rústica: ';
                            echo ($campos['tipo_local'] == 'finca') ? 'Finca' : (($campos['tipo_local'] == 'castillo') ? 'Castillo' : (($campos['tipo_local'] == 'casa_rural') ? 'Casa Rural' : (($campos['tipo_local'] == 'casa_pueblo') ? 'Casa de Pueblo' : (($campos['tipo_local'] == 'cortijo') ? 'Cortijo' : $campos['tipologia_chalet']))));
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

                    <h3>Otras características:</h3>
                    <ul>
                        <?php 
                            if (!empty( $campos['otra_caract_inm'] )){
                            foreach ( $campos['otra_caract_inm'] as $caracteristica ) {
                                echo '<li>' . esc_html( $caracteristica ) . '</li>';
                            }  
                        }
                        ?>   
                    </ul>
                    
                </div>

                <!-- Segunda columna -->
                <div class="column-list">
                    <h3>Equipamiento</h3>
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
                    <h3>Certificado energético</h3>
                    <ul>
                        <?php
                        //Consumo
                        if ( !empty( $campos['calif_consumo_energ'] ) ) {
                            echo '<li>Consumo: <strong>' . esc_html( $campos['calif_consumo_energ'] ) . '</strong>';
                            if ( !empty( $campos['consumo_energ'] ) ) {
                                echo esc_html( $campos['consumo_energ'] )  . 'kWh/m² año';
                            }
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <h3>Emisiones</h3>
                    <ul>
                        <?php
                        //Emisiones
                        if ( !empty( $campos['cal_emis'] ) ) {
                            echo '<li>: <strong>' . esc_html( $campos['cal_emis'] ) . '</strong>';
                            if ( !empty( $campos['emisiones'] ) ) {
                                echo ' ' . esc_html( $campos['emisiones'] )  . 'kg CO / m2 año';
                            }
                            echo '</li>';
                        }
                        ?>
                        </ul>
                        <?php 
                        if ( !empty( $campos['calif_consumo_energ'] )){
                            echo '<h3>Orientación:</h3>';
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
                            echo '<h3>Equipamiento del local:</h3>';
                            foreach ( $campos['caract_local'] as $carac_local ) {
                                echo '<li>' . esc_html( $carac_local ) . '</li>';
                            }  
                        }
                        if(!empty( $campos['caract_local'] )){
                            echo '<h3>Características del garaje</h3>';
                            foreach ( $campos['caract_garaje'] as $caracteristica_garaje ) {
                                echo '<li>' . esc_html( $caracteristica_garaje ) . '</li>';
                            }
                        }





                    ?>

                </div>
            </div>
        </div>

    <!-- Listado de inmueble -->
    <?php else: ?>
        <a href="<?php the_permalink(); ?>">
            <div class="inmuebles-details">
                <!-- Galería de imágenes -->
                <div class="inmuebles-gallery">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($campos['galeria_imagenes'] as $imagen) : ?>   
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
                <!-- Contenido del inmueble -->
                <div class="inmuebles-content">
                    <!-- Título -->
                    <h2><?php echo $tipos_inmueble_map[$tipo_inmueble] . ' en ' . $campos['nombre_calle'] . ', ' . $campos['localidad']; ?></h2>
                    <!-- Precio -->
                    <p class="inmuebles-price">
                        <?php if ($campos['precio_venta']) : ?>
                            <?php echo $campos['precio_venta']; ?> €
                        <?php else: ?>
                            <?php echo $campos['precio_alquiler']; ?> €/mes
                        <?php endif; ?>
                    </p>
                    <!-- Características -->
                    <div class="inmuebles-features">
                        <?php if ($campos['num_dormitorios']) : ?>
                            <span><?php echo $campos['num_dormitorios'] . ' hab.'; ?></span>
                        <?php endif; ?>
                        <?php if ($campos['m_construidos']) : ?>
                            <span><?php echo $campos['m_construidos'] . ' m²'; ?></span>
                        <?php endif; ?>
                    </div>
                    <!-- Descripción -->
                    <?php if ($campos['descripcion']) : ?>
                        <div class="inmuebles-description">
                            <p><?php echo $campos['descripcion']; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    <?php endif; ?>
    
</article>

    <!-- Initialize Swiper -->
    <script>
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
</script>