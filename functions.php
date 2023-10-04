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
 * @snippet      Menús de administración que SÍ se ven - El resto desaparecen 
 * @author       https://ayudawp.com/ocultar-menus-admin/
 */

 /* add_action('admin_init', 'ayudawp_admin_init');
 function ayudawp_admin_init()
 {
     // Verificar si el usuario actual es un administrador
     if (!current_user_can('administrator')) {
         // Menús que se quedan para el rol de administrador
         $menus_to_stay = array(
             // Escritorio
             'index.php',
             // Medios
             'upload.php',
             // Usuarios
             'users.php',
             //CPT Inmueble
             'edit.php?post_type=inmueble',
             // Feed de idealista
             'admin.php?page=idealista-properties-feed',
         );
 
         foreach ($GLOBALS['menu'] as $key => $value) {
             if (!in_array($value[2], $menus_to_stay)) {
                 remove_menu_page($value[2]);
             }
         }
        
     }
 } */
 

 



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



/* ocultar_cosas_para_no_administradores */

function ocultar_avisos_para_no_administradores() {
    if (!current_user_can('administrator')) {
        remove_action('admin_notices', 'my_admin_notice');

        // Agrega CSS personalizado para ocultar elementos adicionales
        echo '<style>
            
            #wp-admin-bar-comments,
            #wp-admin-bar-new-content, 
            #wp-admin-bar-archive, 
            #wp-admin-bar-edit-profile, 
            #wp-admin-bar-wp-logo, 
            .woocommerce-layout__activity-panel,
            #screen-meta-links {

                display: none !important;
            }

            </style>';
    }
}
add_action('admin_init', 'ocultar_avisos_para_no_administradores');