<?php

/**
 * Registra las áreas de widgets
 */
function inmuebles_setup_widgets() {
	register_sidebar(
		[
			'id'            => 'sidebar-widgets',
			'name'          => __( 'Sidebar widgets', 'inmuebles' ),
			'description'   => __( 'Drag widgets to this sidebar container.', 'inmuebles' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title h5">',
			'after_title'   => '</h4>',
		]
	);

	register_sidebar(
		[
			'id'            => 'footer-widgets',
			'name'          => __( 'Footer widgets', 'inmuebles' ),
			'description'   => __( 'Drag widgets to this footer container', 'inmuebles' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title h5">',
			'after_title'   => '</h4>',
		]
	);
}