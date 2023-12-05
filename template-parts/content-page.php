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

    body .type-page .featured-image {
        width: 100vw;
        margin-left: calc(-50vw + 50%);
       

    }

    body .type-page .featured-image img{
        width: 100%;
        min-width: 300px; /* Ajusta el valor según sea necesario */
        height: auto;
        object-fit: cover;
    }
    
    #content{
        margin-top: 0px !important;
    }
    
    body .type-page .post-title::after {
        background: 0 !important;
    }

    body .type-page .post-title {
        margin-bottom: 0px  !important;
        padding-bottom: 0px !important;
    }

    body .type-page .title-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.99); /* Ajusta el sombreado según sea necesario */
    }

    

    @media screen and (max-width: 767px) {
        body .type-page .title-container {
        width: 85%;
        top: 60%;
        }
}
</style>