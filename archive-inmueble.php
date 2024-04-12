<?php
/**
 * The template for displaying all single inmueble
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package chipicasa
 */
get_header();


// Array asociativo para mapear valores de los tipos de inmueble
global $tipos_inmueble_map;
?>
<section class="property-grid grid">
    <div class="container">
        <div class="row px-md-3">
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array('post_type' => 'inmueble', 'posts_per_page' => 9, 'paged' => $paged);
                    $query = new WP_Query($args);
                    ?>
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post() ?>
                            <?php
                            $tipo_inmueble = unserialize(get_post_meta(get_the_ID(), 'tipo_inmueble', true));
                            $campos = obtener_campos_inmueble($post->ID);
                            ?>
                            <div class="col-md-4">
                                <a href="<?php the_permalink(); ?>">
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
                                                        <?php echo esc_html__($tipos_inmueble_map[$tipo_inmueble], 'chipicasa'); ?>
                                                        <br /> <?php echo esc_html__('in', 'chipicasa'); ?> <?php echo esc_html__($campos['nombre_calle'], 'chipicasa'); ?>

                                                    </h2>
                                                </div>
                                                <div class="card-body-a">
                                                    <div class="price-box d-flex">
                                                        <span class="price-a">
                                                            <?php if ($campos['precio_venta']) : ?>
                                                                <?php echo number_format( $campos['precio_venta'], 0, ',', '.' ); ?> €
                                                            <?php else : ?>
                                                                <?php printf(esc_html__('%s €/mes', 'chipicasa'), $campos['precio_alquiler']); ?>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="card-footer-a">
                                                    <ul class="card-info d-flex justify-content-around">
                                                        <?php if ($tipo_inmueble == 'terreno') { ?>
                                                            <li>
                                                                <?php if ($campos['superf_terreno'] ?? '') : ?>
                                                                    <h4 class="card-info-title"><?php echo esc_html__('Parcela de', 'chipicasa'); ?></h4>
                                                                    <span>
                                                                            <span><?php echo esc_html($campos['superf_terreno']); ?>m<sup>2</sup></span>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php } else { ?>
                                                            <li>
                                                                <?php if ($campos['m_construidos']) : ?>
                                                                    <h4 class="card-info-title"><?php echo esc_html__('Area', 'chipicasa'); ?></h4>
                                                                    <span>
                                                                        <span><?php echo $campos['m_construidos']; ?></span>m<sup>2</sup>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </li>
                                                            <li>
                                                                <?php if ($campos['num_dormitorios']) : ?>
                                                                    <h4 class="card-info-title"><?php echo esc_html__('Beds', 'chipicasa'); ?></h4>
                                                                    <span><?php echo $campos['num_dormitorios']; ?></span>
                                                                <?php endif; ?>
                                                            </li>
                                                            <li>
                                                                <?php if ($campos['num_banos']) : ?>
                                                                    <h4 class="card-info-title"><?php echo esc_html__('Baths', 'chipicasa'); ?></h4>
                                                                    <span><?php echo $campos['num_banos']; ?></span>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                        <?php
                        // Restore original Post Data
                        wp_reset_postdata();
                        ?>
                    <?php else : ?>
                        <?php get_template_part('template-parts/content-none'); ?>
                    <?php endif; ?>
                </div>
                <?php
                // Pagination
                get_template_part('template-parts/pagination');
                ?>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <!-- Sidebar -->
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
