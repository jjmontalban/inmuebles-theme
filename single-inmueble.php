<?php
get_header(); // Llama al encabezado del tema
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while (have_posts()) : the_post();
        ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php
                    if (has_post_thumbnail()) {
                        // Muestra la imagen destacada
                        the_post_thumbnail();
                    }

                    // Muestra el contenido del inmueble
                    the_content();
                    ?>
                </div>

            </article>

        <?php
        endwhile; // Fin del loop de WordPress
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar(); // Llama a la barra lateral del tema
get_footer(); // Llama al pie de página del tema
