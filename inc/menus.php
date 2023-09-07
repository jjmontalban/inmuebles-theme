<?php

add_action( 'widgets_init', 'inmuebles_setup_widgets' );

/**
 * Registra los menús de navegación
 */
function inmuebles_register_menus() {
	register_nav_menu( 'main-menu', __( 'Main menu', 'inmuebles' ) );
	register_nav_menu( 'mobile-menu', __( 'Mobile menu', 'inmuebles' ) );
}
add_action( 'after_setup_theme', 'inmuebles_register_menus' );