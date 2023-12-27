<?php
/**
 * Template Name: Quiero Vender
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
        <div class="venta-container">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <p><?php echo get_post_meta(get_the_ID(), '_eslogan', true); ?></p>
            <div class="entry-content">
                
                <?php the_content(); ?>
            </div>
        </div>
    </header>
    
    
    
    <footer>
        <span class="edit-link"><?php edit_post_link( __( '(Edit)', 'inmuebles' ) ); ?></span>
    </footer>
</article>


    <style>

        #content {
        margin-top: 0;
        }

        body .type-page .venta-container {
            position: absolute;
            top: 50%;
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


        /* customizacion de propiedades globales */
        .featured-image {
            margin-bottom: 0 !important;
        }
        #content article.hentry {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
        #content article.hentry header{
            margin-bottom: 0 !important;
        }


        /* Modificar la posición en dispositivos móviles usando clases de Bootstrap */
        @media (max-width: 1023px) {
            
            body .type-page .venta-container {
                position: relative;
                margin-top: -15%; /* Ajusta la distancia desde arriba */
            }
        }

    </style>
</main>
<?php get_footer(); ?>
