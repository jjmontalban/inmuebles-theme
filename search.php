<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package chipicasa
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'chipicasa' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h1>
        </header><!-- .page-header -->

        <?php
        // Obtener los parámetros de búsqueda
        $tipo_inmueble = isset($_GET['tipo_inmueble']) ? sanitize_text_field($_GET['tipo_inmueble']) : '';
        $tipo_operacion = isset($_GET['tipo_operacion']) ? sanitize_text_field($_GET['tipo_operacion']) : '';

        // Construir el array de argumentos de la consulta
        $search_args = array(
            's' => get_search_query(),
            'post_type' => 'inmueble', // El tipo de post que estás buscando
            'meta_query' => array(
                'relation' => 'AND', // Relación entre las condiciones de meta_query
            ),
        );

        // Añadir condiciones de tipo_inmueble y tipo_operacion si están presentes
        if ($tipo_inmueble) {
            $search_args['meta_query'][] = array(
                'key' => 'tipo_inmueble',
                'value' => $tipo_inmueble,
                'compare' => '=',
            );
        }

        if ($tipo_operacion) {
            $search_args['meta_query'][] = array(
                'key' => 'tipo_operacion',
                'value' => $tipo_operacion,
                'compare' => '=',
            );
        }

        // Realizar la consulta
        $search_query = new WP_Query( $search_args );

        // Mostrar resultados
        if ( $search_query->have_posts() ) :
            while ( $search_query->have_posts() ) : $search_query->the_post();
                // Mostrar resultados
                get_template_part( 'template-parts/content', 'search' );
            endwhile;
            wp_reset_postdata();
        else :
            // Mostrar mensaje de que no se encontraron resultados
            get_template_part( 'template-parts/content', 'none' );
        endif;

        // Mostrar paginación
        the_posts_navigation();

        ?>

    <?php else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
?>
