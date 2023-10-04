<?php get_header(); ?>
<main id="main" class="columns large-9 small-12">

	<div class="author-info">
		<h2 class="author-heading"><?php _e( 'Posts published by', 'domestika' ); ?></h2>
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
		</div>
		<div class="author-description">
			<h3 class="author-title"><?php echo get_the_author(); ?></h3>
			<p class="author-bio">
				<?php the_author_meta( 'description' ); ?>
			</p>
		</div>
	</div>

	<?php get_template_part( 'template-parts/loop' );  ?>	

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
