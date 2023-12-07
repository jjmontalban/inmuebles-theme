<?php
/**
 * Template Name: Full contact
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
            <p class="slogan"><?php echo get_post_meta(get_the_ID(), '_eslogan', true); ?></p>  
            <div class="form-shortcode-container"><?php echo do_shortcode('[formulario_contacto]'); ?></div>
        </div>
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
        margin-top: 0px !important;
    }
    #content article.hentry {
        margin-bottom: 0;
        padding-bottom: 0;
    }

    body .type-page .featured-image{
        margin-bottom: 0;
    }

    #content article.hentry header {
        padding: 0;
        margin-bottom: 0;
    }

    body .type-page .featured-image {
        margin-left: calc(-50vw + 50%);
    }

    body .type-page .featured-image img{
        width: 100%;
        min-width: 300px;
        object-fit: cover;
        max-height: 50rem;
    }

    body .type-page .post-title::after {
        background: 0 !important;
    }

    body .type-page .post-title {
        margin-bottom: 0px  !important;
        padding-bottom: 0px !important;
    }

    

</style>
</main>
<?php get_footer(); ?>
