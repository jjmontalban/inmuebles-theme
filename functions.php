<?php

/**
 * Configuración básica del tema
 */
function inmuebles_setup_theme(){
	// HTML5 para los formularios de búsqueda, comentarios, galerías...
    $supports = [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ];
    add_theme_support( 'html5', $supports );
	// Soporte para etiqueta <title> dentro de <head>
    add_theme_support( 'title-tag' );
	// Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );
	
	// Anchura del contenido. Para vídeos embebidos
    $GLOBALS['content-width'] = 1130;

	// Soporte para internacionalización
    load_theme_textdomain( 'inmuebles', get_template_directory() . '/languages' );

	// Registro de tamaños de imágenes
	add_image_size( 'featured-medium', 870, 500, true );
	add_image_size( 'featured-page', 1920, 400, true );
}
add_action('after_setup_theme', 'inmuebles_setup_theme', 10 );


require 'inc/menus.php';
require 'inc/widgets.php';
require 'inc/scripts.php';
require 'inc/templates.php';