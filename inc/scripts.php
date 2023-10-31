<?php

/**
 * Añade todos los scripts y estilos necesarios para el funcionamiento del tema.
 */

//CSS
function chipicasa_load_css() {
	wp_enqueue_style( 'chipicasa-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'chipicasa_load_css' );


//GOOGLE FONTS
function chipicasa_add_google_fonts() {
    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,300;8..60,400;8..60,500;8..60,700;8..60,900&display=swap', false ); 
}
add_action( 'wp_enqueue_scripts', 'chipicasa_add_google_fonts' );


//JAVASCRIPT
function chipicasa_load_js(){
	wp_register_script('scripts', get_template_directory_uri() . '/inc/scripts.js', array('jquery'), false, true); 
	wp_enqueue_script('scripts');
}
add_action('wp_enqueue_scripts', 'chipicasa_load_js');