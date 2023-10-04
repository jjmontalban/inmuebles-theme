<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ) : the_post() ?>
			<?php get_template_part( 'template-parts/content', get_post_type() )  ?>
			
		<?php endwhile; ?>
			<?php get_template_part( 'template-parts/pagination' );  ?>
		
		<?php else: ?>
			<?php get_template_part( 'template-parts/no-content' );  ?>
	<?php endif; ?>