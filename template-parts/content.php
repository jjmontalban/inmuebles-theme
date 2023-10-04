<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header>
					<?php if ( is_home() && is_sticky() ): ?>
						<div class="featured-tag">
							<?php _e( 'Featured', 'inmuebles' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ): ?>
						<div class="featured-image">
							<?php if ( is_page() ): ?>
								<?php the_post_thumbnail( 'featured-page' ); ?>
							<?php else: ?>
								<?php the_post_thumbnail( 'featured-medium' ); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<p class="post-categories"><?php echo get_the_category_list( ' / ' ); ?></p>
					<?php if ( is_singular() ): ?>
						<h1 class="post-title"><?php the_title(); ?></h1>
					<?php else: ?>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>
				</header>
				<div class="entry-content">
					<time class="updated" datetime="<?php echo get_the_time( 'c' ); ?>">
						<?php the_date(); ?>
					</time>

					<span class="byauthor">
						| <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>
					</span>
					<?php if ( is_singular() ): ?>
						<?php the_content(); ?>
						<?php wp_link_pages(); ?>
					<?php else: ?>
						<?php the_excerpt(); ?>
					<?php endif; ?>
				</div>
				<footer>
					<ul class="post-tags"><?php the_tags( '<li>', '</li><li>', '</li>' ); ?></ul>
					<span class="edit-link"><?php edit_post_link( __( '(Edit)', 'inmuebles' ) ); ?></span>
				</footer>
			</article>