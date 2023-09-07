<?php if ( ! is_page() && is_active_sidebar( 'sidebar-widgets' ) ): ?>
		<div class="sidebar columns large-3 small-12">
			<aside class="sidebar">
				<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
			</aside>
		</div>
	<?php endif; ?>