<section class="latest-inmuebles">
        <h3>Últimos inmuebles añadidos</h3>
        <?php
        $args = array(
            'post_type' => 'inmueble',
            'posts_per_page' => 9,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $query = new WP_Query($args);
        global $tipos_inmueble_map;
        
        if ($query->have_posts()): ?>
            <div class="inmueble-row">
                <?php while ($query->have_posts()): $query->the_post(); ?>
                    <?php $campos = obtener_campos_inmueble(get_the_ID());  ?>
                    <div class="inmueble-item">
                        <!-- Mostrar la imagen por defecto -->
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail(); ?>
                        <?php endif; ?>
                        <div class="inmueble-precio">
                            <p class="inmuebles-price">
                                <?php if ($campos['precio_venta']) : ?>
                                    <?php echo $campos['precio_venta']; ?> €
                                <?php else: ?>
                                    <?php echo $campos['precio_alquiler']; ?> €/mes
                                <?php endif; ?>
                            </p>
                        </div>
                        <h5><?php echo $tipos_inmueble_map[$campos['tipo_inmueble']] . ' en ' . $campos['nombre_calle'] . ', ' . $campos['localidad']; ?></h5>
                        <div class="inmueble-info">
                            <span><?php echo $campos['m_construidos'] . ' m2'; ?></span>
                            <span><?php echo $campos['num_dormitorios'] . ' Dorm'; ?></span>
                            <span><?php echo $campos['num_dormitorios'] . ' Baño'; ?></span>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-inmueble">Ver inmueble</a>


                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </section>