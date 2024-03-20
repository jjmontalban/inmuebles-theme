<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package chipicasa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header id="masthead" class="site-header">
    <!--/ Nav Star /-->
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
        <div class="container">
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
            aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <div class="navbar-brand text-brand">
                <?php the_custom_logo(); ?>
            </div>
            <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
            data-target="#navbarTogglerDemo01" aria-expanded="false">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>
            <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_class'     => 'navbar-nav',
                    'container'      => false,
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'         => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
            </div>
            <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse"
            data-target="#navbarTogglerDemo01" aria-expanded="false">
                <span class="fa fa-search" aria-hidden="true"></span>
            </button>


            <!--/ START Form Search Star /-->
            <div class="click-closed"></div>
            <div class="box-collapse">
                <div class="title-box-d">
                <h3 class="title-d"><?php echo esc_html__( 'Search Property', 'chipicasa' ); ?></h3>
                </div>
                <span class="close-box-collapse right-boxed ion-ios-close"></span>
                <div class="box-collapse-wrap form">
                    <?php get_search_form();  ?>
                </div>
            </div>
            <!--/ END Form Search Star /-->

        </div>
    </nav>
    <!--/ Nav End /-->
</header><!-- #masthead -->
