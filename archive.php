<?php get_header(); ?>
<main id="main" class="columns large-9 small-12">

	<h1 class="page-title"><?php the_archive_title(); ?></h1>
	<div class="taxonomy-description"><?php the_archive_description() ?></div>

    <?php get_template_part( 'template-parts/loop' );  ?>	

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
