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



 /**
 * @snippet      Custom Login 
 * @author       https://codex.wordpress.org/Customizing_the_Login_Form
 * @author       https://wordpress.stackexchange.com/questions/99027/remove-links-from-login-page
 */
function my_login_logo() { 
    ?>
    <style type="text/css">
            
      #login h1 a, .login h1 a {
        background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/img/login.png');
        height: 225px;
        width: 70%;
        background-size: cover;
        background-repeat: no-repeat;
      }

      .login form{
        background-color: #fff;
        border: 0;
      }

      .login{
        background:  #fff;;
      }

      .language-switcher,
      .privacy-policy-page-link,
      #nav,
      #backtoblog{
          display:none
      }
        
    </style>
    <?php 
  }
  add_action( 'login_enqueue_scripts', 'my_login_logo' );



  /**
 * @snippet       redirigir_gestor_a_pagina_personalizada
 * @author        ayudawp
 */
  
///////////////////////////////
function redirigir_gestor_a_pagina_personalizada( $user_login, $user ) {

    global $current_user;
     $user_roles = $current_user->roles;
     $role = array_shift($user_roles);


     if( $role != 'administrator') {
        wp_redirect( admin_url( '/edit.php?post_type=inmueble' ) );
        exit();
    }
}
add_action( 'wp_login', 'redirigir_gestor_a_pagina_personalizada', 10, 2 );





  /**
 * @snippet       eslogan
 */
  
///////////////////////////////
// Función para agregar el metabox
function agregar_metabox_eslogan() {
    add_meta_box('eslogan-metabox', 'Eslogan', 'mostrar_metabox_eslogan', 'page', 'normal', 'high');
}

// Función para mostrar el contenido del metabox
function mostrar_metabox_eslogan($post) {
    $eslogan = get_post_meta($post->ID, '_eslogan', true);
    ?>
    <label for="eslogan">Eslogan:</label>
    <input type="text" id="eslogan" name="eslogan" value="<?php echo esc_attr($eslogan); ?>" style="width: 100%;">
    <?php
}

// Función para guardar el valor del metabox
function guardar_eslogan($post_id) {
    if (array_key_exists('eslogan', $_POST)) {
        update_post_meta(
            $post_id,
            '_eslogan',
            sanitize_text_field($_POST['eslogan'])
        );
    }
}

// Acciones para agregar el metabox y guardar el valor
add_action('add_meta_boxes', 'agregar_metabox_eslogan');
add_action('save_post', 'guardar_eslogan');


 

  /**
 * @snippet       nombre de remintente email CRM
 */
function cambiar_nombre_remitente_email($original_email_from) {
    return 'CRM chipicasa.com';
}
add_filter('wp_mail_from_name', 'cambiar_nombre_remitente_email');


// Habilitar la carga de archivos SVG
function permitir_svg_upload( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'permitir_svg_upload' );
