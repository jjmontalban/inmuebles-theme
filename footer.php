<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chipicasa
 */

?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
			<nav class="nav-footer">
				<?php
				if ( is_active_sidebar( 'footer-1' ) ) { dynamic_sidebar( 'footer-1' ); }
				?>
			</nav>
			<div class="copyright-footer">
				<p class="copyright color-text-a">
					&copy;<?php echo esc_html(date(' Y ')) . '<span class="color-a"> ' . esc_html( get_bloginfo('name') ) . '</span>'; ?>       
				</p>
			</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
