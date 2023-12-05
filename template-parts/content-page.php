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
</style>