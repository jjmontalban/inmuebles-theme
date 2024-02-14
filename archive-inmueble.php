<?php get_header(); ?>

<?php 

    //array asociativo para mapear valores de los tipos de inmueble
    global $tipos_inmueble_map;

?>

<main id="main" class="columns large-9 small-12">
    <?php if ( have_posts() ): ?>
        <?php while ( have_posts() ) : the_post() ?>
        <?php 
        $tipo_inmueble = get_post_meta(get_the_ID(), 'tipo_inmueble', true);

        //
        $campos = obtener_campos_inmueble($post->ID);  
        ?>
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Listado de inmueble -->
                 <!-- Detalles de un inmueble -->
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
                    <h2><?php echo $tipos_inmueble_map[$tipo_inmueble] . ' en ' . $campos['nombre_calle']; ?></h2>
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
                            <p><?php echo substr($campos['descripcion'], 0, 150) . '...'; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
            </article>
        <?php endwhile; ?>
        <?php get_template_part( 'template-parts/pagination' ); ?>
    <?php else: ?>
        <?php get_template_part( 'template-parts/no-content' ); ?>
    <?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

    <!-- Iniciar Swiper -->
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