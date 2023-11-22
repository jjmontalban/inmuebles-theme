    <h3 class="latest-inmuebles">Últimos inmuebles añadidos</h3>
    <section class="latest-inmuebles">
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
                            <div class="info-item">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/m_construidos.svg" alt="Metros Construidos">
                                <span><?php echo $campos['m_construidos']; ?></span>
                            </div>
                            <div class="info-item">
                                <img class="icono" src="<?php echo get_template_directory_uri(); ?>/img/m_utiles.svg" alt="Metros Útiles">
                                <span><?php echo $campos['m_utiles']; ?></span>
                            </div>
                            <div class="info-item">
                                <img class="icono" src="<?php echo get_template_directory_uri(); ?>/img/num_dormitorios.svg" alt="Dormitorios">
                                <span><?php echo $campos['num_dormitorios']; ?></span>
                            </div>
                            <div class="info-item">
                                <img class="icono" src="<?php echo get_template_directory_uri(); ?>/img/num_banos.svg" alt="Baños">
                                <span><?php echo get_post_meta(get_the_ID(), 'num_banos', true); ?></span>
                            </div>
                        </div>
                        <a href="   <?php the_permalink(); ?>" class="btn-inmueble">Ver inmueble</a>


                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; wp_reset_postdata(); ?>
    </section>