<style>


    /* Estilos generales */
.inmueble-details {
    margin: 20px;
}

.inmueble-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.feature {
    display: flex;
    align-items: center;
    margin-right: 15px;
}

.feature i {
    margin-right: 5px;
}

.inmueble-gallery {
    margin-top: 20px;
}

.swiper-slide img {
    width: 100%;
    height: auto;
}


</style>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <!-- Imagen destacada -->
        <?php if ( has_post_thumbnail() ): ?>
            <div class="featured-image">
                <?php the_post_thumbnail( 'featured-page' ); ?>
            </div>
        <?php endif; ?>
    </header>
    <div class="inmueble-details">
        <div class="inmueble-meta">
            
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
            
            // Obtener los campos personalizados
            $nombre_calle = get_post_meta(get_the_ID(), 'nombre_calle', true);
            $localidad = get_post_meta(get_the_ID(), 'localidad', true);
            $num_dormitorios = get_post_meta(get_the_ID(), 'num_dormitorios', true);
            $num_banos = get_post_meta(get_the_ID(), 'num_banos', true);
            $m_construidos = get_post_meta(get_the_ID(), 'm_construidos', true);
            $descripcion = get_post_meta(get_the_ID(), 'descripcion', true);
            $galeria_imagenes = get_post_meta(get_the_ID(), 'galeria_imagenes', true);
            $precio_venta = get_post_meta(get_the_ID(), 'precio_venta', true);
            $precio_alquiler = get_post_meta(get_the_ID(), 'precio_alquiler', true);
            
            ?>
            
            <!-- Muestra el tipo de inmueble, nombre calle y localidad -->
            <div class="inmueble-title">
                <h2><?php echo $tipos_inmueble_map[$tipo_inmueble]; ?></h2>
                <p><?php echo $nombre_calle; ?>, <?php echo $localidad; ?></p>
            </div>
            
            <!-- Muestra los campos personalizados con iconos -->
            <div class="inmueble-features">
                <?php if ($num_dormitorios) : ?>
                    <div class="feature">
                        <i class="fa fa-bed"></i>
                        <span><?php echo $num_dormitorios; ?></span>
                    </div>
                <?php endif; ?>
    
                <?php if ($num_banos) : ?>
                    <div class="feature">
                        <i class="fa fa-bath"></i>
                        <span><?php echo $num_banos; ?></span>
                    </div>
                <?php endif; ?>
    
                <?php if ($m_construidos) : ?>
                    <div class="feature">
                        <i class="fa fa-home"></i>
                        <span><?php echo $m_construidos; ?> m²</span>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Muestra el precio -->
            <div class="inmueble-price">
                <?php if ($precio_venta) : ?>
                    <p><?php echo $precio_venta; ?> €</p>
                <?php else: ?>
                    <p><?php echo $precio_alquiler; ?> €/mes</p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Muestra la descripción -->
        <div class="inmueble-description">
            <?php if ($descripcion) : ?>
                <p><?php echo $descripcion; ?></p>
            <?php endif; ?>
        </div>
        
        <!-- Muestra la galería de imágenes -->
        <?php if( is_single() && !empty($galeria_imagenes) ): ?>
            <div class="inmueble-gallery">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($galeria_imagenes as $imagen) : ?>
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
        <?php endif; ?>
    </div>

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
    
</article>
