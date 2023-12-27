<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <?php if ( has_post_thumbnail() ): ?>
      <div class="featured-image">
          <?php the_post_thumbnail( 'featured-page' ); ?>
      </div>
    <?php endif; ?>

    <h1 class="post-title"><?php the_title(); ?></h1>

  </header>
  <div class="entry-content">
      <?php the_content(); ?>
      <?php wp_link_pages(); ?>
  </div>
  <footer>
    <span class="edit-link"><?php edit_post_link( __( '(Edit)', 'domestika' ) ); ?></span>
  </footer>
</article>
