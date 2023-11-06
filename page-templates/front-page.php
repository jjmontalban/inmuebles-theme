<?php
/**
 * Template Name: Front page
 */
?>

<style>

.latest-inmuebles .inmueble-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}


.inmueble-item {
    width: 32%; /* Para hacer que encajen 3 por fila */
    margin-bottom: 20px;
    position: relative;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Sombra ligera */
    transition: box-shadow 0.3s ease; /* Transición suave para el efecto hover */
}


.info-item {
    width: 48%;
    display: flex;
    align-items: center;
    padding-left: 30px; 
    padding-right: 30px;
    box-sizing: border-box;
}

.inmueble-info {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 20px;
    position: relative;
}


.info-item img {
    margin-right: 10px;
}

/* Alinea el primer y tercer elemento a la izquierda */
.inmueble-info .info-item:nth-child(odd) {
    justify-content: flex-start;
}

/* Alinea el segundo y cuarto elemento a la derecha */
.inmueble-info .info-item:nth-child(even) {
    justify-content: flex-end;
}

/* Responsive: 1 inmueble por fila en pantallas pequeñas */
@media (max-width: 768px) {
    .inmueble-item {
        width: 100%;
    }
    .info-item {
        width: 100%;
        justify-content: flex-start;
    }

}

.btn-inmueble {
    display: block;
    background-color: #333;
    color: #fff;
    font-size: 0.8em;
    width: 50%; /* Establece el ancho del botón al 50% de su contenedor */
    margin-left: 25%; /* Centra el botón */
    text-align: center;
    padding: 5px 10px;
    text-decoration: none;
    transition: background-color 0.3s;
    margin-bottom: 4%;
}

.btn-inmueble:hover {
    color: #fff;
    background-color: #ff6900;
}

.inmueble-precio {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(255, 255, 255, 0.7);
    font-weight: bold;
}

.latest-inmuebles {
    text-align: center;
}




</style>



<?php get_header(); ?>
<main id="main" class="columns large-12 small-12">
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
</main>
<?php get_footer(); ?>
