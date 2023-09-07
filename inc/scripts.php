<?php

/**
 * Añade todos los scripts y estilos necesarios para el funcionamiento del tema.
 */
function inmuebles_enqueue_scripts() {
	wp_enqueue_style( 'inmuebles-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'inmuebles_enqueue_scripts' );