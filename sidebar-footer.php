<?php if ( is_active_sidebar( 'footer-widgets' ) ) : ?>
		<div class="footer-container row">
			<div class="sidebar columns small-12">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</div>
		</div>
	<?php endif; ?>