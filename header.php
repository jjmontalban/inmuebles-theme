<!DOCTYPE html>
<html <?php language_attributes(  ); ?>>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Biblioteca swiper -->
	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
	  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    
	<?php wp_head(  ); ?>
</head>

<body>
<header class="site-header">
        <div class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Logo">
        </div>

        <div class="navigation-main-menu">
            <div class="navigation-wrap">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php _e( 'Top Menu', 'inmuebles' ); ?>">
                    <?php if ( has_nav_menu( 'main-menu' ) ): ?>
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'main-menu',
                                'menu_id'        => 'main-menu',
                            ]
                        );
                        ?>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    
        <div class="mobile-menu-toggle">
            <button class="accordion-toggle">
                <img src="<?php echo get_template_directory_uri(); ?>/img/menu-circle.svg" alt="Menú">
            </button>
        </div>
    </header>
    <!-- Añade el siguiente bloque para el menú móvil -->
    <div class="mobile-menu-wrapper">
        <div class="accordion-content">
            <?php if ( has_nav_menu( 'mobile-menu' ) ): ?>
                <?php
                wp_nav_menu(
                    [
                        'theme_location' => 'mobile-menu',
                        'menu_id'        => 'mobile-menu',
                    ]
                );
                ?>
            <?php endif; ?>
        </div>
    </div>


    <script>
    jQuery(document).ready(function($) {
        // Agregar función para mostrar/ocultar menú móvil al hacer clic en el botón o icono
        $('.mobile-menu-toggle').on('click', '.accordion-toggle', function() {
            // Alternar la visibilidad del menú móvil (acordeón)
            $('.accordion-content').slideToggle();
        });
    });
    </script>



	<!-- Formulario de búsqueda. No mostrar en singles -->
	<?php if (!is_singular('inmueble')): ?>
		<?php get_search_form( );  ?>
	<?php endif; ?>

	<div id="content" class="row">