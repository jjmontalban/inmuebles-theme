<?php get_header(); ?>

<?php 
    // Array asociativo para mapear valores de los tipos de inmueble
    global $tipos_inmueble_map;
?>
<div class="row">
    <div class="col-md-8">
        <section class="property-grid grid">
            <div class="container">
                <div class="row">
                    <?php if ( have_posts() ): ?>
                        <?php while ( have_posts() ) : the_post() ?>
                            <?php 
                            $tipo_inmueble = get_post_meta(get_the_ID(), 'tipo_inmueble', true);
                            $campos = obtener_campos_inmueble($post->ID);  
                            ?> 
                            <div class="col-md-4">
                                <div class="card-box-a card-shadow">
                                    <div class="img-box-a">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'img-a img-fluid']); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-overlay">
                                        <div class="card-overlay-a-content">
                                            <div class="card-header-a">
                                                <h2 class="card-title-a">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php echo esc_html__( $tipos_inmueble_map[$tipo_inmueble], 'chipicasa' ); ?>
                                                        <br /> <?php echo esc_html__( 'en', 'chipicasa' ); ?> <?php echo esc_html__( $campos['nombre_calle'], 'chipicasa' ); ?>
                                                    </a>
                                                </h2>
                                            </div>
                                            <div class="card-body-a">
                                                <div class="price-box d-flex">
                                                    <span class="price-a">
                                                        <?php if ($campos['precio_venta']) : ?>
                                                            <?php echo $campos['precio_venta']; ?> €
                                                        <?php else: ?>
                                                            <?php echo $campos['precio_alquiler']; ?> €/mes
                                                        <?php endif; ?>
                                                    </span>
                                                </div>
                                                <a href="<?php the_permalink(); ?>" class="link-a">
                                                    <?php echo esc_html__( 'Click here to view', 'chipicasa' ); ?>
                                                    <span class="ion-ios-arrow-forward"></span>
                                                </a>
                                            </div>
                                            <div class="card-footer-a">
                                                <ul class="card-info d-flex justify-content-around">
                                                    <li>
                                                        <?php if ($campos['m_construidos']) : ?>
                                                            <h4 class="card-info-title"><?php echo esc_html__( 'Area', 'chipicasa' ); ?></h4>
                                                            <span>
                                                                <span><?php echo $campos['m_construidos']; ?></span>m<sup>2</sup>
                                                            </span>
                                                        <?php endif; ?> 
                                                    </li>
                                                    <li>
                                                        <?php if ($campos['num_dormitorios']) : ?>
                                                            <h4 class="card-info-title"><?php echo esc_html__( 'Beds', 'chipicasa' ); ?></h4>
                                                            <span><?php echo $campos['num_dormitorios']; ?></span>
                                                        <?php endif; ?>
                                                    </li>
                                                    <li>
                                                        <?php if ($campos['num_banos']) : ?>
                                                            <h4 class="card-info-title"><?php echo esc_html__( 'Baths', 'chipicasa' ); ?></h4>
                                                            <span><?php echo $campos['num_banos']; ?></span>
                                                        <?php endif; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php get_template_part( 'template-parts/pagination' ); ?>
                    <?php else: ?>
                        <?php get_template_part( 'template-parts/no-content' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4">
        <section class="property-grid grid">
            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </section>
    </div>
</div>
<?php get_footer(); ?>
