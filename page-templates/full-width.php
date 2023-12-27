<?php
/**
 * Template Name: Full width
 */
?>
<?php get_header(); ?>
<main id="main" class="columns large-12 small-12">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php if ( has_post_thumbnail() ): ?>
            <div class="featured-image">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
        <?php endif; ?>
        <div class="title-container">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <p><?php echo get_post_meta(get_the_ID(), '_eslogan', true); ?></p>  
        </div>
        <?php get_search_form( );  ?>
    </header>
    
    
    
    <div class="entry-content">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
    </div>
    <footer>
        <span class="edit-link"><?php edit_post_link( __( '(Edit)', 'inmuebles' ) ); ?></span>
    </footer>
</article>


<style>

    #content {
       margin-top: 0;
    }

    body .type-page .title-container {
        position: absolute;
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.99);
    }

    body .type-page .featured-image img {
        min-height: 20rem;
        min-width: auto;
    }

/* Modificar la posición en dispositivos móviles usando clases de Bootstrap */
@media (max-width: 1023px) {
    
    body .type-page .title-container {
        position: relative;
        margin-top: -70%; /* Ajusta la distancia desde arriba */
    }
}

</style>


</main>
<?php get_footer(); ?>
